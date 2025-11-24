<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CleanupExpiredSessions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sessions:cleanup {--force : Force cleanup without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up expired sessions from the database to prevent lock table size issues';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sessionLifetime = config('session.lifetime', 120); // minutes
        $expiredTime = Carbon::now()->subMinutes($sessionLifetime);
        
        // Count expired sessions
        $expiredCount = DB::table('sessions')
            ->where('last_activity', '<', $expiredTime->timestamp)
            ->count();
        
        if ($expiredCount === 0) {
            $this->info('No expired sessions found.');
            return Command::SUCCESS;
        }
        
        if (!$this->option('force')) {
            if (!$this->confirm("Found {$expiredCount} expired sessions. Do you want to delete them?")) {
                $this->info('Cleanup cancelled.');
                return Command::SUCCESS;
            }
        }
        
        // Delete expired sessions
        $deleted = DB::table('sessions')
            ->where('last_activity', '<', $expiredTime->timestamp)
            ->delete();
        
        $this->info("Successfully deleted {$deleted} expired session(s).");
        
        // Also clean up sessions older than 7 days as a safety measure
        $oldTime = Carbon::now()->subDays(7);
        $oldCount = DB::table('sessions')
            ->where('last_activity', '<', $oldTime->timestamp)
            ->count();
        
        if ($oldCount > 0) {
            $deletedOld = DB::table('sessions')
                ->where('last_activity', '<', $oldTime->timestamp)
                ->delete();
            
            $this->info("Also deleted {$deletedOld} very old session(s) (older than 7 days).");
        }
        
        return Command::SUCCESS;
    }
}
