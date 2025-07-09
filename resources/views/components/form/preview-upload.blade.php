@props([ 'file' => null, 'label' => 'Preview File', 'id' => 'previewModal' .
uniqid(), ]) @if ($file && method_exists($file, 'temporaryUrl')) @php $ext =
strtolower($file->getClientOriginalExtension()); $mime = $file->getMimeType();
@endphp

<div class="">
    {{-- Label di atas file --}}
    <label class="text-sm text-gray-600 font-medium block mb-1">
        {{ $label }}
    </label>

    @if (\Illuminate\Support\Str::startsWith($mime, 'image'))
    <img
        src="{{ $file->temporaryUrl() }}"
        class="mt-2 rounded shadow border object-cover"
        style="width: 120px; height: 180px"
    />
    @elseif ($ext === 'pdf')
    <button
        type="button"
        onclick="document.getElementById('{{ $id }}').showModal()"
        class="bg-blue-500 px-2 py-1 mt-1 rounded-xl text-white hover:bg-blue-600 transition text-sm"
    >
        <div class="text-sm w-full max-w-xs truncate text-white">
            {{ $file->getClientOriginalName() }}
        </div>
    </button>

    <dialog
        id="{{ $id }}"
        class="backdrop:bg-black/50 w-full max-w-4xl rounded-lg shadow-lg p-0 open:flex open:items-center open:justify-center"
    >
        <div class="bg-white rounded-lg w-full">
            <div class="flex justify-between items-center px-4 py-3 border-b">
                <h3 class="text-lg font-semibold text-gray-800">
                    {{ $label }}
                </h3>
                <button
                    onclick="document.getElementById('{{ $id }}').close()"
                    class="text-gray-500 hover:text-red-600 text-lg font-bold transition"
                    title="Tutup"
                >
                    &times;
                </button>
            </div>

            <div class="p-4">
                @if (\Illuminate\Support\Str::startsWith($mime, 'image'))
                <img
                    src="{{ $file->temporaryUrl() }}"
                    class="rounded shadow mt-2 max-w-md mx-auto"
                />
                @elseif ($ext === 'pdf' && $previewAktaUrl =
                $this->previewAktaUrl)
                <iframe
                    src="{{ $previewAktaUrl }}"
                    width="100%"
                    height="500px"
                    class="border rounded"
                    type="application/pdf"
                ></iframe>
                @else
                <p class="text-gray-500 mt-2">
                    File: {{ $file->getClientOriginalName() }}
                </p>
                @endif
            </div>
        </div>
    </dialog>
    @else
    <p class="text-gray-500 mt-2">File: {{ $file->getClientOriginalName() }}</p>
    @endif
</div>
@endif
