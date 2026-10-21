
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('angsuran', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pinjaman_id')
                ->constrained('pinjaman')
                ->cascadeOnDelete();

            $table->unsignedInteger('angsuran_ke');
            $table->decimal('jumlah_angsuran', 15, 2);
            $table->date('tanggal_jatuh_tempo');
            $table->date('tanggal_bayar')->nullable();
            $table->string('status', 20)->default('belum_bayar');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->unique(['pinjaman_id', 'angsuran_ke']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('angsuran');
    }
};