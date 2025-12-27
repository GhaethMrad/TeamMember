<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-indigo-500 border border-transparent rounded-lg font-medium text-sm text-white shadow-md hover:from-indigo-700 hover:to-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 disabled:opacity-50 transition transform hover:-translate-y-0.5']) }}>
    {{ $slot }}
</button>
