<div>
    {{-- Do your work, then step back. --}}
    <div class="container">
        <div class="section-title">
            <h2>Buat Janji</h2>
            <p>Daftarkan kunjungan Anda dengan mengambil antrian online</p>
        </div>

      	<!-- KETIKA FORM DISUBMIT, MAKA AKAN MENJALANKAN METHOD STORE -->
        <form wire:submit.prevent="store" role="form" class="php-email-form">
          
          	<!-- MENAMPILKAN NOTIFIKASI BERHASIL/GAGAL VIA FLASH MESSAGE -->
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tanggal/Hari</label>
                        <select wire:model="day" wire:change="getTimeSlot($event.target.value)" class="form-control">
                            <option value="">Pilih</option>
                            @foreach ($days as $row)
                            <option value="{{ $row['day'] }}">{{ $row['label'] }}</option>
                            @endforeach
                        </select>
                        @error('day') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Waktu Kedatangan</label>
                        <select wire:model="slot" class="form-control">
                            <option value="">Pilih</option>
                            @foreach ($timeSlot as $val)
                                <option value="{{ $val->id }}" {{ ($val->orders_count >= $val->quota) ? 'disabled="disabled"':'' }}>
                                    {{ $val->name }} ({{ $val->orders_count }}/{{ $val->quota }} Kuota)
                                </option>
                            @endforeach
                        </select>
                        @error('slot') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="">Nama Lengkap</label>
                <input type="text" wire:model="name" class="form-control">
                @error('name') <p class="text-danger">{{ $message }}</p> @enderror
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Umur</label>
                        <input type="number"  wire:model="age" class="form-control">
                        @error('age') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Whatsapp</label>
                        <br>
                        <input type="text" wire:model="phone_number" class="form-control" placeholder="08******">
                        @error('phone_number') <p class="text-danger">{{ $message }}</p> @enderror
                        <span class="badge rounded-pill text-bg-warning">Mohon Masukan Nomor yang dapat di hubungi via Whatsapp/Telpon</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="">Keperluan</label>
                <select wire:model="note" onchange="showHideNote()" id="note" class="form-control">
                    <option value="">Pilih</option>
                    <option value="Pelayanan Rawat Jalan">Pelayanan Rawat Jalan</option>
                    <option value="Pelayanan Rawat Inap">Pelayanan Rawat Inap</option>
                    <option value="Pelayanan Ibu dan Anak Terpadu">Pelayanan Ibu dan Anak Terpadu</option>
                    <option value="Pelayanan Bedah Sentral dan Anastesi">Pelayanan Bedah Sentral dan Anastesi</option>
                    <option value="Lain-Lain">Lain-Lain</option>
                </select>
                @error('note') <p class="text-danger">{{ $message }}</p> @enderror
            </div>
            <div wire:ignore.self class="form-group" id="note_form" style="display: none">
                <label for="">Catatan</label>
                <textarea wire:model="note_additional" class="form-control" id="note_additional" cols="5" rows="5"></textarea>
                @error('note_additional') <p class="text-danger">{{ $message }}</p> @enderror
            </div>
            
            <div class="text-center">
                <button type="submit">Buat Janji</button>
            </div>
        </form>
    </div>

    <script>
        function showHideNote() {
            getValue = document.getElementById("note").value;
            if (getValue == 'Lain-Lain') {
                document.getElementById('note_form').style.display = "block";
            } else {
                document.getElementById('note_form').style.display = "none";
            }
        }
    </script>
</div>
