<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\AttachmentStoreRequest;
use App\Models\Attachment;
use App\Models\Task;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    use AuthorizesRequests;

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
}
