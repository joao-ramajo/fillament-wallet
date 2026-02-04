<?php

namespace App\Console\Commands\Source;

use App\Models\User;
use Illuminate\Console\Command;

class SyncUsersSource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-users-source';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincroniza todos os usuários para garantir que possuem uma fonte padrão e atualiza as despesas existentes para usar essa fonte.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::with('sources')->each(function ($user) {
            $source = $user->sources()->firstOrCreate(
                ['is_default' => true],
                ['name' => 'Principal', 'color' => '#4F46E5']
            );

            $user->expenses()
            ->whereNull('source_id')
            ->update(['source_id' => $source->id]);
        });
    }
}
