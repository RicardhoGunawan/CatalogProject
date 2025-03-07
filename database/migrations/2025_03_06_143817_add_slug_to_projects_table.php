<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Project;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
        });

        // Generate slug untuk data yang sudah ada
        $this->generateSlugsForExistingProjects();

        // Setelah semua slug dibuat, kita bisa menjadikannya unique dan required
        Schema::table('projects', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }

    /**
     * Generate slug untuk project yang sudah ada
     */
    private function generateSlugsForExistingProjects(): void
    {
        foreach (Project::all() as $project) {
            $project->slug = Str::slug($project->title);
            $project->saveQuietly(); // saveQuietly agar tidak trigger events
        }
    }
};