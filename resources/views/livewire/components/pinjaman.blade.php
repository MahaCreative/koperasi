<div>
    <section id="" class="pt-12 pb-16 px-12 bg-transparent">
        <div class="flex flex-wrap justify-center items-center">
            <div class="w-full lg:w-1/2 lg:px-10">
                <h3 class="font-bold text-dark text-[24pt] lg:text-[45pt]">Ajukan Pinjaman Tanpa Jaminan</h3>
                <p class="font-light text-[12pt] lg:text-[18pt]">Hanya dengan KTP, dapatkan kredit tanpa agunan hingga
                    <span class="font-bold"> Rp20.000.000</span>
                </p>
                <p class="text-light text-secondary text-[12pt] lg:text-[18pt]">Koperasi berkah sejahtera, adalah
                    koperasi yang berada di kota malunda provinsi sulawesi Barat yang telah berdiri sejak tahun 2014</p>
            </div>
            <div class="w-full lg:w-1/2">
                <div class="flex flex-col">
                    <div class="flex justify-between">
                        <h3 class="font-bold text-[12pt] lg:text-[18pt]">Jumlah Pinjaman</h3>
                        <h3 class="font-bold text-[12pt] lg:text-[18pt] text-primary" id="jumlahPinjaman">
                            {{ $valselectPinjaman }} Juta</h3>
                    </div>
                    <div class="relative pt-1">
                        <label for="customRange1" class="form-label"></label>
                        <select wire:change="changePinjaman($event.target.value)" wire:model="selectPinjaman"
                            class="w-full border border-emerald-400" name="" id="">
                            <option value="0">Pilih Pinjaman</option>
                            @forelse ($pinjaman as $item)
                                <option value="{{ $item->id }}">{{ $item->pinjaman }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="flex justify-between">
                        <p class="font-light text-secondary">{{ $minPinjaman }}</p>
                        <p class="font-light text-secondary">{{ $maxPinjaman }}</p>
                    </div>

                    <div class="flex justify-between">
                        <h3 class="font-bold text-[12pt] lg:text-[18pt]">Lama Pinjaman</h3>
                        <h3 class="font-bold text-[12pt] lg:text-[18pt] text-primary" id="lamaPinjaman">
                            {{ $valselectDurasi }} X</h3>
                    </div>
                    <div class="relative pt-1">
                        <label for="customRange1" class="form-label"></label>
                        <select wire:change="changeDurasi($event.target.value)" wire:model="selectDurasi"
                            class="w-full border border-emerald-400" name="" id="">
                            <option value="0">Pilih Pinjaman</option>
                            @forelse ($durasi as $item)
                                <option value="{{ $item->id }}">{{ $item->durasi_angsuran }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="flex justify-between">
                        <hp class="font-light text-secondary">{{ $minDurasi }}</hp>
                        <hp class="font-light text-secondary">{{ $maxDurasi }}</hp>
                    </div>
                    <div class="flex flex-col justify-between items-center">
                        <h3 class="font-bold text-primary">Cicilan per bulan</h3>
                        <p class="font-light text-secondary text-[12pt]">*sudah termasuk bunga dan biaya admin</p>
                        <p class="font-bold text-primary text-[24pt]">
                            Rp. 209.600
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
