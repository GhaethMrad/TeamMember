<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\AttachmentStoreRequest;
use App\Models\Attachment;
use App\Models\Task;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    use AuthorizesRequests;

    public function index() 
    {
        $this->authorize('viewAny', Attachment::class);
        return view('frontend.attachment.index', [
            'attachments' => Attachment::all(),
        ]);
    }

    public function show(Attachment $attachment) 
    {
        $this->authorize('view', Attachment::class);
        return view('frontend.attachment.show', ['attachment' => $attachment]);
    }

    public function upload(AttachmentStoreRequest $request, Task $task)
    {
        try {
            $this->authorize('uploadAttachment', [Attachment::class, $task]);
            
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $filePath = $file->store('attachments', 'public');

                    $task->attachments()->create([
                        'file_path' => $filePath,
                        'file_type' => $file->getClientMimeType(),
                    ]);
                }
            }
            return redirect()->route('task.show', $task->id)->with('status', 'done');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Attachment $attachment)
    {
        try {
            $this->authorize('delete', Attachment::class);
            Storage::disk('public')->delete($attachment->file_path);
            $attachment->delete();
            return redirect()->route('attachment.index')->with('status', 'done');
        } catch (Exception $error) {
            return redirect()->route('attachment.index')->with('error', $error->getMessage());
        }
    }
}
