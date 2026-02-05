<?php

namespace App\Console\Commands\Source;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
        $this->info('Iniciando sincronização de fontes dos usuários...');

        DB::table('users')->get()->each(function ($user) {
            $this->line("Processando usuário ID {$user->id}...");

            $sourceId = DB::table('sources')
            ->where('user_id', $user->id)
            ->where('is_default', true)
            ->value('id');

            if (!$sourceId) {
                $sourceId = DB::table('sources')->insertGetId([
                'user_id' => $user->id,
                'name' => 'Principal',
                'color' => '#4F46E5',
                'is_default' => true,
                'allow_negative' => false,
                'created_at' => now(),
                'updated_at' => now(),
                ]);

                $this->info("Fonte padrão criada (ID {$sourceId}).");
            } else {
                $this->line("Fonte padrão já existe (ID {$sourceId}).");
            }

            $updated = DB::table('expenses')
            ->where('user_id', $user->id)
            ->update(['source_id' => $sourceId]);

            $this->line("Despesas atualizadas: {$updated}");
        });

        $this->info('Sincronização concluída com sucesso.');
    }
}
