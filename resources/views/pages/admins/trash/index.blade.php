@extends('admins.layout')

@section('content')
<div class="relative w-full h-[calc(100vh-48px)] p-5 overflow-auto">

    {{-- MESSAGES MODAL --}}
    @if (session()->has('success'))
        <div id="successModal" class="bg-black/50 min-h-screen fixed inset-0 flex justify-center items-center">
            <div class="bg-white w-1/2 lg:w-1/3 rounded-lg p-4">
                <div class="flex justify-between items-center text-2xl text-black">
                    <h4 class="font-semibold"><i class="fa-solid fa-check text-white bg-blue-500 rounded-full p-1 mr-4"></i>Success</h4>
                    <button title="Close" onclick="CloseModal('successModal')">
                        <i class="fa-solid fa-xmark hover:cursor-pointer"></i>
                    </button>
                </div>
                <hr class="my-2">
                <div>
                    <p class="text-slate-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif
    @if (session()->has('fail'))
        <div id="failModal" class="bg-black/50 min-h-screen fixed inset-0 flex justify-center items-center">
            <div class="bg-white w-1/2 lg:w-1/3 rounded-lg p-4">
                <div class="flex justify-between items-center text-2xl text-black">
                    <h4 class="font-semibold"><i class="fa-solid fa-xmark text-white bg-red-500 rounded-full p-1 mr-4"></i>Failed</h4>
                    <button title="Close" onclick="CloseModal('failModal')">
                        <i class="fa-solid fa-xmark hover:cursor-pointer"></i>
                    </button>
                </div>
                <hr class="my-2">
                <div>
                    <p class="text-slate-700">{{ session('fail') }}</p>
                </div>
            </div>
        </div>
    @endif
    {{-- END MESSAGES MODAL --}}

    {{-- TOGGLE TABLE BUTTONS --}}
    <div class="w-full max-h-full flex justify-center items-center text-white">
        <button onclick="TableHewan('table-list-hewan')" class="w-1/5 bg-blue-500 hover:bg-blue-700 inline-block rounded-l-sm text-center py-1 px-3">
            <i class="fa-solid fa-paw"></i>
            <span class="hidden xl:inline-block xl:ml-2">Hewan</span> 
        </button>
        <button onclick="TableKingdom('table-kingdom')" class="w-1/5 bg-blue-500 hover:bg-blue-700 inline-block text-center py-1 px-3">
            <i class="fa-solid fa-crown"></i>
            <span class="hidden xl:inline-block xl:ml-2">Kingdom</span> 
        </button>
        <button onclick="TableHabitat('table-habitat')" class="w-1/5 bg-blue-500 hover:bg-blue-700 inline-block text-center py-1 px-3">
            <i class="fa-solid fa-location-dot"></i>
            <span class="hidden xl:inline-block xl:ml-2">Habitat</span> 
        </button>
        <button onclick="TableKB('table-KB')" class="w-1/5 bg-blue-500 hover:bg-blue-700 inline-block text-center py-1 px-3">
            <i class="fa-solid fa-egg"></i>
            <span class="hidden xl:inline-block xl:ml-2">Kembang Biak</span> 
        </button>
        <button onclick="TableMakanan('table-makanan')" class="w-1/5 bg-blue-500 hover:bg-blue-700 inline-block rounded-r-sm text-center py-1 px-3">
            <i class="fa-solid fa-utensils"></i>
            <span class="hidden xl:inline-block xl:ml-2">Makanan</span> 
        </button>
    </div>
    {{-- END TOGGLE TABLE BUTTONS --}}

    <hr class="my-2 invisible">

    {{-- TABLE HEWAN --}}
    <div class="flex" id="table-list-hewan">
        {{-- DATA TABLE --}}
        <div class="py-5 bg-slate-500 inline-block rounded-lg shadow-lg shadow-black/50">
            <table class="table-fixed w-full gap-2">
                <thead class="border-b mb-6 text-white">
                    <tr>
                        <th class="w-[40px]">No.</th>
                        <th>Nama Hewan</th>
                        <th class="hidden lg:table-cell">Kingdom</th>
                        <th class="hidden lg:table-cell">Habitat</th>
                        <th class="hidden lg:table-cell">Cara Kembang Biak</th>
                        <th class="hidden lg:table-cell">Makanan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="bg-slate-100 font-medium">
                    @foreach ($hewans as $hewan)
                    <tr>
                        <td class="text-center">{{ $loop->iteration . "." }}</td>
                        <td class="border-x border-slate-500">{{ $hewan->nama }}</td>
                        <td class="border-x border-slate-500 hidden lg:table-cell">{{ $hewan->kingdom->nama }}</td>
                        <td class="border-x border-slate-500 hidden lg:table-cell">{{ $hewan->habitat->nama }}</td>
                        <td class="border-x border-slate-500 hidden lg:table-cell">{{ $hewan->kembang_biak->nama }}</td>
                        <td class="border-x border-slate-500 hidden lg:table-cell">{{ $hewan->makanan->nama }}</td>
                        <td>
                            <div class="w-full h-full text-white flex justify-center items-center">
                                <button type="button" title="Detail" onclick="ShowModal('detailModalHewan-{{ $hewan->id }}')" 
                                    class="bg-green-500 hover:bg-green-700 w-1/3 rounded-l-sm text-center py-1">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <form class="w-1/3" action="{{ route('recycle.hewan',$hewan->id) }}" method="post">
                                    @csrf
                                    <button type="submit" title="Recycle" class="bg-blue-500 hover:bg-blue-700 w-full rounded-l-sm text-center py-1">
                                        <i class="fa-solid fa-recycle"></i>
                                    </button>
                                </form>
                                <button type="button" title="Delete" onclick="ShowModal('deleteModalHewan-{{ $hewan->id }}')"
                                    class="bg-red-500 hover:bg-red-700 w-1/3 rounded-r-sm text-center py-1">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>

                                {{-- DELETE MODAL --}}
                                <div id="deleteModalHewan-{{ $hewan->id }}" class="bg-black/50 min-h-screen fixed inset-0 hidden justify-center items-center">
                                    <div class="bg-white w-1/2 lg:w-1/3 rounded-lg p-4">
                                        <div class="flex justify-between items-center text-2xl text-black">
                                            <h4 class="font-semibold"><i class="fa-solid fa-triangle-exclamation text-red-500 mr-4"></i>Confirm Delete</h4>
                                            <button type="button" title="Close" onclick="CloseModal('deleteModalHewan-{{ $hewan->id }}')">
                                                <i class="fa-solid fa-xmark hover:cursor-pointer"></i>
                                            </button>
                                        </div>
                                        <hr class="my-2">
                                        <div>
                                            <p class="text-slate-700">Are you sure wanna trash this {{ $hewan->nama }}? You won't get em back unless you make a new data</p>
                                        </div>
                                        <hr class="my-2">
                                        <div class="flex justify-end items-center gap-2">
                                            <button type="button" title="Cancel" onclick="CloseModal('deleteModalHewan-{{ $hewan->id }}')" class="bg-slate-300 hover:bg-slate-500 text-black py-1 px-3 rounded font-semibold">No! Spare the {{ $hewan->nama }}</button>
                                            <form action="{{ route('trash.hewan', $hewan->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 py-1 px-3 rounded font-semibold">Trash em!</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- END DELETE MODAL --}}

                                {{-- DETAIL MODAL --}}
                                <div id="detailModalHewan-{{ $hewan->id }}" class="bg-black/50 min-h-screen fixed inset-0 hidden justify-center items-center">
                                    <div class="bg-white w-1/2 rounded-lg p-4">
                                        <div class="flex justify-between items-center text-2xl text-black">
                                            <h4 class="font-semibold"><i class="fa-solid fa-info text-green-500 mr-4"></i>Show Detail</h4>
                                            <button type="button" title="Close" onclick="CloseModal('detailModalHewan-{{ $hewan->id }}')">
                                                <i class="fa-solid fa-xmark hover:cursor-pointer"></i>
                                            </button>
                                        </div>
                                        <hr class="my-2">
                                        <div class="w-full text-slate-700 flex justify-around items-start">
                                            <div class="w-5/11">
                                                <p class="font-bold">Nama   </p>
                                                <p class="font-bold">Kingdom</p>
                                                <p class="font-bold">Habitat</p>
                                                <p class="font-bold">Berkembang Biak</p>
                                                <p class="font-bold">Jenis Makanan</p>
                                            </div>
                                            <div class="w-1/11 text-center">
                                                <p>:</p>
                                                <p>:</p>
                                                <p>:</p>
                                                <p>:</p>
                                                <p>:</p>
                                            </div>
                                            <div class="w-5/11">
                                                <p>{{ $hewan->nama }}</p>
                                                <p>{{ $hewan->kingdom->nama }}</p>
                                                <p>{{ $hewan->habitat->nama }}</p>
                                                <p>{{ $hewan->kembang_biak->nama }} ({{ $hewan->kembang_biak->keterangan }})</p>
                                                <p>{{ $hewan->makanan->nama }} ({{ $hewan->makanan->keterangan }})</p>
                                            </div>
                                        </div>
                                        <hr class="my-2">
                                        <div>
                                            <h4 class="text-black font-semibold text-xl">Note : {{ $hewan->kingdom->nama }}</h4>
                                            <p class="text-slate-700">{{ $hewan->kingdom->keterangan }} <br>Termasuk dalam jenis <span class="font-bold">{{ $hewan->kingdom->jenis }}</span></p>
                                        </div>
                                        <hr class="my-2">
                                        <div class="flex justify-end items-center gap-2">
                                            <button type="button" title="Back" onclick="CloseModal('detailModalHewan-{{ $hewan->id }}')" class="bg-slate-300 hover:bg-slate-500 text-black py-1 px-3 rounded font-semibold">Back</button>
                                        </div>
                                    </div>
                                </div>
                                {{-- END DETAIL MODAL --}}

                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- END DATA TABLE --}}
    </div>
    {{-- END TABLE HEWAN --}}

    {{-- TABLE KINGDOM --}}
    <div class="hidden" id="table-kingdom">
        {{-- DATA TABLE --}}
        <div class="py-5 bg-slate-500 inline-block rounded-lg shadow-lg shadow-black/50">
            <table class="table-fixed w-full gap-2">
                <thead class="border-b mb-6 text-white">
                    <tr>
                        <th class="w-[40px]">No.</th>
                        <th>Nama Kingdom</th>
                        <th class="hidden lg:table-cell">Jenis</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="bg-slate-100 font-medium">
                    @foreach ($kingdoms as $kingdom)
                    <tr>
                        <td class="text-center">{{ $loop->iteration . "." }}</td>
                        <td class="border-x border-slate-500">{{ $kingdom->nama }}</td>
                        <td class="border-x border-slate-500 hidden lg:table-cell">{{ $kingdom->jenis }}</td>
                        <td class="border-x border-slate-500">{{ Str::limit($kingdom->keterangan,18) }}</td>
                        <td>
                            <div class="w-full h-full text-white flex justify-center items-center">
                                <button type="button" title="Detail" onclick="ShowModal('detailModalKingdom-{{ $kingdom->id }}')" 
                                    class="bg-green-500 hover:bg-green-700 w-1/3 rounded-l-sm text-center py-1">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <form class="w-1/3" action="{{ route('recycle.kingdom',$kingdom->id) }}" method="post">
                                    @csrf
                                    <button type="submit" title="Detail" class="bg-blue-500 hover:bg-blue-700 w-full rounded-l-sm text-center py-1">
                                        <i class="fa-solid fa-recycle"></i>
                                    </button>
                                </form>
                                <button type="button" title="Delete" onclick="ShowModal('deleteModalKingdom-{{ $kingdom->id }}')"
                                    class="bg-red-500 hover:bg-red-700 w-1/3 rounded-r-sm text-center py-1">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>

                                {{-- DELETE MODAL --}}
                                <div id="deleteModalKingdom-{{ $kingdom->id }}" class="bg-black/50 min-h-screen fixed inset-0 hidden justify-center items-center">
                                    <div class="bg-white w-1/2 lg:w-1/3 rounded-lg p-4">
                                        <div class="flex justify-between items-center text-2xl text-black">
                                            <h4 class="font-semibold"><i class="fa-solid fa-triangle-exclamation text-red-500 mr-4"></i>Confirm Delete</h4>
                                            <button type="button" title="Close" onclick="CloseModal('deleteModalKingdom-{{ $kingdom->id }}')">
                                                <i class="fa-solid fa-xmark hover:cursor-pointer"></i>
                                            </button>
                                        </div>
                                        <hr class="my-2">
                                        <div>
                                            <p class="text-slate-700">Are you sure wanna trash this {{ $kingdom->nama }}? You won't get em back unless you make a new data</p>
                                        </div>
                                        <hr class="my-2">
                                        <div class="flex justify-end items-center gap-2">
                                            <button type="button" title="Cancel" onclick="CloseModal('deleteModalKingdom-{{ $kingdom->id }}')" class="bg-slate-300 hover:bg-slate-500 text-black py-1 px-3 rounded font-semibold">No! Spare the {{ $kingdom->nama }}</button>
                                            <form action="{{ route('trash.kingdom', $kingdom->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 py-1 px-3 rounded font-semibold">Trash em!</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- END DELETE MODAL --}}

                                {{-- DETAIL MODAL --}}
                                <div id="detailModalKingdom-{{ $kingdom->id }}" class="bg-black/50 min-h-screen fixed inset-0 hidden justify-center items-center">
                                    <div class="bg-white w-1/2 rounded-lg p-4">
                                        <div class="flex justify-between items-center text-2xl text-black">
                                            <h4 class="font-semibold"><i class="fa-solid fa-info text-green-500 mr-4"></i>Show Detail</h4>
                                            <button type="button" title="Close" onclick="CloseModal('detailModalKingdom-{{ $kingdom->id }}')">
                                                <i class="fa-solid fa-xmark hover:cursor-pointer"></i>
                                            </button>
                                        </div>
                                        <hr class="my-2">
                                        <div>
                                            <h4 class="text-black font-semibold text-xl">{{ $kingdom->nama }}</h4>
                                            <p class="text-slate-700">{{ $kingdom->keterangan }} <br>Termasuk dalam jenis <span class="font-bold">{{ $kingdom->jenis }}</span></p>
                                        </div>
                                        <hr class="my-2">
                                        <div class="flex justify-end items-center gap-2">
                                            <button type="button" title="Back" onclick="CloseModal('detailModalKingdom-{{ $kingdom->id }}')" 
                                                class="bg-slate-300 hover:bg-slate-500 text-black py-1 px-3 rounded font-semibold">
                                                Back
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {{-- END DETAIL MODAL --}}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- END DATA TABLE --}}
    </div>
    {{-- END TABLE KINGDOM --}}

    {{-- TABLE HABITAT --}}
    <div class="hidden w-full lg:w-3/5" id="table-habitat">
        {{-- DATA TABLE --}}
        <div class="py-5 bg-slate-500 inline-block rounded-lg shadow-lg shadow-black/50">
            <table class="table-fixed w-full gap-2">
                <thead class="border-b mb-6 text-white">
                    <tr>
                        <th class="w-[40px]">No.</th>
                        <th>Nama Habitat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="bg-slate-100 font-medium">
                    @foreach ($habitats as $habitat)
                    <tr>
                        <td class="text-center">{{ $loop->iteration . "." }}</td>
                        <td class="border-x border-slate-500">{{ $habitat->nama }}</td>
                        <td>
                            <div class="w-full h-full text-white flex justify-center items-center">
                                <button type="button" title="Detail" onclick="ShowModal('detailModalHabitat-{{ $habitat->id }}')" 
                                    class="bg-green-500 hover:bg-green-700 w-1/3 rounded-l-sm text-center py-1">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <form class="w-1/3" action="{{ route('recycle.habitat',$habitat->id) }}" method="post">
                                    @csrf
                                    <button type="submit" title="Detail" class="bg-blue-500 hover:bg-blue-700 w-full rounded-l-sm text-center py-1">
                                        <i class="fa-solid fa-recycle"></i>
                                    </button>
                                </form>
                                <button type="button" title="Delete" onclick="ShowModal('deleteModalHabitat-{{ $habitat->id }}')"
                                    class="bg-red-500 hover:bg-red-700 w-1/3 rounded-r-sm text-center py-1">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>

                                {{-- DELETE MODAL --}}
                                <div id="deleteModalHabitat-{{ $habitat->id }}" class="bg-black/50 min-h-screen fixed inset-0 hidden justify-center items-center">
                                    <div class="bg-white w-1/2 lg:w-1/3 rounded-lg p-4">
                                        <div class="flex justify-between items-center text-2xl text-black">
                                            <h4 class="font-semibold"><i class="fa-solid fa-triangle-exclamation text-red-500 mr-4"></i>Confirm Delete</h4>
                                            <button type="button" title="Close" onclick="CloseModal('deleteModalHabitat-{{ $habitat->id }}')">
                                                <i class="fa-solid fa-xmark hover:cursor-pointer"></i>
                                            </button>
                                        </div>
                                        <hr class="my-2">
                                        <div>
                                            <p class="text-slate-700">Are you sure wanna trash this {{ $habitat->nama }}? You won't get em back unless you make a new data</p>
                                        </div>
                                        <hr class="my-2">
                                        <div class="flex justify-end items-center gap-2">
                                            <button type="button" title="Cancel" onclick="CloseModal('deleteModalHabitat-{{ $habitat->id }}')" class="bg-slate-300 hover:bg-slate-500 text-black py-1 px-3 rounded font-semibold">No! Spare the {{ $habitat->nama }}</button>
                                            <form action="{{ route('trash.habitat', $habitat->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 py-1 px-3 rounded font-semibold">Trash em!</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- END DELETE MODAL --}}

                                {{-- DETAIL MODAL --}}
                                <div id="detailModalHabitat-{{ $habitat->id }}" class="bg-black/50 min-h-screen fixed inset-0 hidden justify-center items-center">
                                    <div class="bg-white w-1/3 rounded-lg p-4">
                                        <div class="flex justify-between items-center text-2xl text-black">
                                            <h4 class="font-semibold"><i class="fa-solid fa-info text-green-500 mr-4"></i>Show Detail</h4>
                                            <button type="button" title="Close" onclick="CloseModal('detailModalHabitat-{{ $habitat->id }}')">
                                                <i class="fa-solid fa-xmark hover:cursor-pointer"></i>
                                            </button>
                                        </div>
                                        <hr class="my-2">
                                        <div>
                                            <h4 class="text-black font-semibold text-xl">{{ $habitat->nama }}</h4>
                                        </div>
                                        <hr class="my-2">
                                        <div class="flex justify-end items-center gap-2">
                                            <button type="button" title="Back" onclick="CloseModal('detailModalHabitat-{{ $habitat->id }}')" 
                                                class="bg-slate-300 hover:bg-slate-500 text-black py-1 px-3 rounded font-semibold">
                                                Back
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {{-- END DETAIL MODAL --}}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- END DATA TABLE --}}
    </div>
    {{-- TABLE HABITAT --}}

    {{-- TABLE KEMBANG BIAK --}}
    <div class="hidden w-full lg:w-3/5" id="table-KB">
        {{-- DATA TABLE --}}
        <div class="py-5 bg-slate-500 inline-block rounded-lg shadow-lg shadow-black/50">
            <table class="table-fixed w-full gap-2">
                <thead class="border-b mb-6 text-white">
                    <tr>
                        <th class="w-[40px]">No.</th>
                        <th>Metode Berkembang Biak</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="bg-slate-100 font-medium">
                    @foreach ($KBs as $KB)
                    <tr>
                        <td class="text-center">{{ $loop->iteration . "." }}</td>
                        <td class="border-x border-slate-500">{{ $KB->nama }}</td>
                        <td>
                            <div class="w-full h-full text-white flex justify-center items-center">
                                <button type="button" title="Detail" onclick="ShowModal('detailModalKB-{{ $KB->id }}')" 
                                    class="bg-green-500 hover:bg-green-700 w-1/3 rounded-l-sm text-center py-1">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <form class="w-1/3" action="{{ route('recycle.kembang_biak',$KB->id) }}" method="post">
                                    @csrf
                                    <button type="submit" title="Detail" class="bg-blue-500 hover:bg-blue-700 w-full rounded-l-sm text-center py-1">
                                        <i class="fa-solid fa-recycle"></i>
                                    </button>
                                </form>
                                <button type="button" title="Delete" onclick="ShowModal('deleteModalKB-{{ $KB->id }}')"
                                    class="bg-red-500 hover:bg-red-700 w-1/3 rounded-r-sm text-center py-1">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>

                                {{-- DELETE MODAL --}}
                                <div id="deleteModalKB-{{ $KB->id }}" class="bg-black/50 min-h-screen fixed inset-0 hidden justify-center items-center">
                                    <div class="bg-white w-1/2 lg:w-1/3 rounded-lg p-4">
                                        <div class="flex justify-between items-center text-2xl text-black">
                                            <h4 class="font-semibold"><i class="fa-solid fa-triangle-exclamation text-red-500 mr-4"></i>Confirm Delete</h4>
                                            <button type="button" title="Close" onclick="CloseModal('deleteModalKB-{{ $KB->id }}')">
                                                <i class="fa-solid fa-xmark hover:cursor-pointer"></i>
                                            </button>
                                        </div>
                                        <hr class="my-2">
                                        <div>
                                            <p class="text-slate-700">Are you sure wanna trash this {{ $KB->nama }}? You won't get em back unless you make a new data</p>
                                        </div>
                                        <hr class="my-2">
                                        <div class="flex justify-end items-center gap-2">
                                            <button type="button" title="Cancel" onclick="CloseModal('deleteModalKB-{{ $KB->id }}')" class="bg-slate-300 hover:bg-slate-500 text-black py-1 px-3 rounded font-semibold">No! Spare the {{ $KB->nama }}</button>
                                            <form action="{{ route('trash.kembang_biak', $KB->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 py-1 px-3 rounded font-semibold">Trash em!</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- END DELETE MODAL --}}

                                {{-- DETAIL MODAL --}}
                                <div id="detailModalKB-{{ $KB->id }}" class="bg-black/50 min-h-screen fixed inset-0 hidden justify-center items-center">
                                    <div class="bg-white w-1/3 rounded-lg p-4">
                                        <div class="flex justify-between items-center text-2xl text-black">
                                            <h4 class="font-semibold"><i class="fa-solid fa-info text-green-500 mr-4"></i>Show Detail</h4>
                                            <button type="button" title="Close" onclick="CloseModal('detailModalKB-{{ $KB->id }}')">
                                                <i class="fa-solid fa-xmark hover:cursor-pointer"></i>
                                            </button>
                                        </div>
                                        <hr class="my-2">
                                        <div>
                                            <h4 class="text-black font-semibold text-xl">{{ $KB->nama }}</h4>
                                            <p class="text-slate-700">Metode berkembang biak dengan cara <span class="font-bold">{{ $KB->keterangan }}</span></p>
                                        </div>
                                        <hr class="my-2">
                                        <div class="flex justify-end items-center gap-2">
                                            <button type="button" title="Back" onclick="CloseModal('detailModalKB-{{ $KB->id }}')" 
                                                class="bg-slate-300 hover:bg-slate-500 text-black py-1 px-3 rounded font-semibold">
                                                Back
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {{-- END DETAIL MODAL --}}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- END DATA TABLE --}}
    </div>
    {{-- END TABLE KEMBANG BIAK --}}

    {{-- TABLE MAKANAN --}}
    <div class="hidden w-full lg:w-3/5" id="table-makanan">
        {{-- DATA TABLE --}}
        <div class="py-5 bg-slate-500 inline-block rounded-lg shadow-lg shadow-black/50">
            <table class="table-fixed w-full gap-2">
                <thead class="border-b mb-6 text-white">
                    <tr>
                        <th class="w-[40px]">No.</th>
                        <th>Jenis Makanan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="bg-slate-100 font-medium">
                    @foreach ($makanans as $makanan)
                    <tr>
                        <td class="text-center">{{ $loop->iteration . "." }}</td>
                        <td class="border-x border-slate-500">{{ $makanan->nama }}</td>
                        <td>
                            <div class="w-full h-full text-white flex justify-center items-center">
                                <button type="button" title="Detail" onclick="ShowModal('detailModalMakanan-{{ $makanan->id }}')" 
                                    class="bg-green-500 hover:bg-green-700 w-1/3 rounded-l-sm text-center py-1">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <form class="w-1/3" action="{{ route('recycle.makanan',$makanan->id) }}" method="post">
                                    @csrf
                                    <button type="submit" title="Detail" class="bg-blue-500 hover:bg-blue-700 w-full rounded-l-sm text-center py-1">
                                        <i class="fa-solid fa-recycle"></i>
                                    </button>
                                </form>
                                <button type="button" title="Delete" onclick="ShowModal('deleteModalMakanan-{{ $makanan->id }}')"
                                    class="bg-red-500 hover:bg-red-700 w-1/3 rounded-r-sm text-center py-1">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>

                                {{-- DELETE MODAL --}}
                                <div id="deleteModalMakanan-{{ $makanan->id }}" class="bg-black/50 min-h-screen fixed inset-0 hidden justify-center items-center">
                                    <div class="bg-white w-1/2 lg:w-1/3 rounded-lg p-4">
                                        <div class="flex justify-between items-center text-2xl text-black">
                                            <h4 class="font-semibold"><i class="fa-solid fa-triangle-exclamation text-red-500 mr-4"></i>Confirm Delete</h4>
                                            <button type="button" title="Close" onclick="CloseModal('deleteModalMakanan-{{ $makanan->id }}')">
                                                <i class="fa-solid fa-xmark hover:cursor-pointer"></i>
                                            </button>
                                        </div>
                                        <hr class="my-2">
                                        <div>
                                            <p class="text-slate-700">Are you sure wanna trash this {{ $makanan->nama }}? You won't get em back unless you make a new data</p>
                                        </div>
                                        <hr class="my-2">
                                        <div class="flex justify-end items-center gap-2">
                                            <button type="button" title="Cancel" onclick="CloseModal('deleteModalMakanan-{{ $makanan->id }}')" class="bg-slate-300 hover:bg-slate-500 text-black py-1 px-3 rounded font-semibold">No! Spare the {{ $makanan->nama }}</button>
                                            <form action="{{ route('trash.makanan', $makanan->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 py-1 px-3 rounded font-semibold">Trash em!</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- END DELETE MODAL --}}

                                {{-- DETAIL MODAL --}}
                                <div id="detailModalMakanan-{{ $makanan->id }}" class="bg-black/50 min-h-screen fixed inset-0 hidden justify-center items-center">
                                    <div class="bg-white w-1/3 rounded-lg p-4">
                                        <div class="flex justify-between items-center text-2xl text-black">
                                            <h4 class="font-semibold"><i class="fa-solid fa-info text-green-500 mr-4"></i>Show Detail</h4>
                                            <button type="button" title="Close" onclick="CloseModal('detailModalMakanan-{{ $makanan->id }}')">
                                                <i class="fa-solid fa-xmark hover:cursor-pointer"></i>
                                            </button>
                                        </div>
                                        <hr class="my-2">
                                        <div>
                                            <h4 class="text-black font-semibold text-xl">{{ $makanan->nama }}</h4>
                                            <p class="text-slate-700">Jenis hewan pemakan <span class="font-bold">{{ $makanan->keterangan }}</span></p>
                                        </div>
                                        <hr class="my-2">
                                        <div class="flex justify-end items-center gap-2">
                                            <button type="button" title="Back" onclick="CloseModal('detailModalMakanan-{{ $makanan->id }}')" 
                                                class="bg-slate-300 hover:bg-slate-500 text-black py-1 px-3 rounded font-semibold">
                                                Back
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {{-- END DETAIL MODAL --}}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- END DATA TABLE --}}
    </div>
    {{-- END TABLE MAKANAN --}}

</div>
@endsection