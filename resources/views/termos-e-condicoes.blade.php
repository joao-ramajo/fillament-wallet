<x-layout.main-layout title="Termos e Condições">
    <div class="min-h-screen bg-zinc-950 text-zinc-100 overflow-hidden">
        <!-- Background brutal shapes -->
        <div class="pointer-events-none fixed inset-0">
            <div class="absolute -top-32 -left-32 w-[40rem] h-[40rem] bg-lime-500/20 rotate-12"></div>
            <div class="absolute top-1/3 -right-40 w-[35rem] h-[35rem] bg-fuchsia-600/20 -rotate-12"></div>
        </div>

        <!-- Header -->
        <x-layout.header />

        <!-- Container -->
        <div class="relative z-10 px-6 py-16 max-w-4xl mx-auto">
            
            <!-- Breadcrumb -->
            <nav class="flex items-center space-x-2 text-sm mb-8">
                <a href="{{ route('web.home') }}" class="text-zinc-400 hover:text-lime-400 transition">Home</a>
                <span class="text-zinc-600">/</span>
                <span class="text-lime-400 font-bold">Termos e Condições</span>
            </nav>

            <!-- Hero Title -->
            <div class="mb-12">
                <h1 class="text-5xl md:text-6xl font-black uppercase mb-6 leading-tight">
                    Termos e <span class="text-lime-400">Condições</span>
                </h1>
                <div class="border-l-4 border-lime-400 pl-6 bg-zinc-900/50 p-6">
                    <p class="text-zinc-300 text-lg leading-relaxed mb-4">
                        <strong class="text-lime-400">Última atualização:</strong> {{ date('d/m/Y') }}
                    </p>
                    <p class="text-zinc-300 text-lg leading-relaxed">
                        Ao usar o <strong class="text-lime-400">Filament Wallet</strong>, você concorda com os seguintes termos e condições.
                        Leia atentamente para entender seus direitos e responsabilidades.
                    </p>
                </div>
            </div>

            <!-- Índice Rápido -->
            <div class="mb-12 border-4 border-lime-400 bg-lime-400/10 p-6">
                <h3 class="text-xl font-black uppercase mb-4 text-lime-400">Índice Rápido</h3>
                <ul class="space-y-2">
                    <li><a href="#coleta-dados" class="text-zinc-300 hover:text-lime-400 transition">1. Coleta e Uso de Dados</a></li>
                    <li><a href="#responsabilidade" class="text-zinc-300 hover:text-lime-400 transition">2. Responsabilidade do Usuário</a></li>
                    <li><a href="#privacidade" class="text-zinc-300 hover:text-lime-400 transition">3. Privacidade e LGPD</a></li>
                    <li><a href="#alteracoes" class="text-zinc-300 hover:text-lime-400 transition">4. Alterações nos Termos</a></li>
                    <li><a href="#dados-financeiros" class="text-zinc-300 hover:text-lime-400 transition">5. Uso dos Dados Financeiros</a></li>
                    <li><a href="#seguranca" class="text-zinc-300 hover:text-lime-400 transition">6. Segurança e Armazenamento</a></li>
                    <li><a href="#limitacao" class="text-zinc-300 hover:text-lime-400 transition">7. Limitação de Responsabilidade</a></li>
                    <li><a href="#propriedade" class="text-zinc-300 hover:text-lime-400 transition">8. Propriedade Intelectual</a></li>
                    <li><a href="#cancelamento" class="text-zinc-300 hover:text-lime-400 transition">9. Cancelamento de Conta</a></li>
                    <li><a href="#contato" class="text-zinc-300 hover:text-lime-400 transition">10. Contato</a></li>
                </ul>
            </div>

            <!-- Seções -->
            <div class="space-y-8">
                
                <!-- 1. Coleta de Dados -->
                <section id="coleta-dados" class="border-4 border-zinc-100 p-6 md:p-8 bg-zinc-900 hover:border-lime-400 transition-colors scroll-mt-24">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="flex-shrink-0 w-10 h-10 bg-lime-400 flex items-center justify-center text-zinc-950 font-black text-xl">
                            1
                        </div>
                        <h2 class="text-2xl md:text-3xl font-black uppercase">Coleta e Uso de Dados</h2>
                    </div>
                    <div class="space-y-4 text-zinc-300 leading-relaxed">
                        <p>
                            Coletamos apenas as informações essenciais para o funcionamento da plataforma:
                        </p>
                        <ul class="list-disc list-inside space-y-2 pl-4">
                            <li><strong>Dados de cadastro:</strong> nome, e-mail e senha criptografada</li>
                            <li><strong>Transações financeiras:</strong> valores, datas, categorias e descrições que você registra</li>
                            <li><strong>Dados de uso:</strong> informações sobre como você interage com a plataforma para melhorias</li>
                        </ul>
                        <p class="text-lime-400 font-bold mt-4">
                            ✓ Não vendemos seus dados para terceiros
                        </p>
                    </div>
                </section>

                <!-- 2. Responsabilidade do Usuário -->
                <section id="responsabilidade" class="border-4 border-zinc-100 p-6 md:p-8 bg-zinc-900 hover:border-lime-400 transition-colors scroll-mt-24">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="flex-shrink-0 w-10 h-10 bg-cyan-400 flex items-center justify-center text-zinc-950 font-black text-xl">
                            2
                        </div>
                        <h2 class="text-2xl md:text-3xl font-black uppercase">Responsabilidade do Usuário</h2>
                    </div>
                    <div class="space-y-4 text-zinc-300 leading-relaxed">
                        <p><strong>Você é responsável por:</strong></p>
                        <ul class="list-disc list-inside space-y-2 pl-4">
                            <li>Fornecer informações verdadeiras e atualizadas</li>
                            <li>Manter suas credenciais de acesso seguras e confidenciais</li>
                            <li>Não compartilhar sua conta com terceiros</li>
                            <li>Usar a plataforma de forma ética e legal</li>
                        </ul>
                        <div class="bg-red-500/10 border-2 border-red-500 p-4 mt-4">
                            <p class="text-red-400 font-bold">
                                ⚠️ O Filament Wallet não se responsabiliza por perdas decorrentes de uso indevido de sua conta.
                            </p>
                        </div>
                    </div>
                </section>

                <!-- 3. Privacidade e LGPD -->
                <section id="privacidade" class="border-4 border-zinc-100 p-6 md:p-8 bg-zinc-900 hover:border-lime-400 transition-colors scroll-mt-24">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="flex-shrink-0 w-10 h-10 bg-fuchsia-500 flex items-center justify-center text-zinc-950 font-black text-xl">
                            3
                        </div>
                        <h2 class="text-2xl md:text-3xl font-black uppercase">Privacidade e LGPD</h2>
                    </div>
                    <div class="space-y-4 text-zinc-300 leading-relaxed">
                        <p>
                            Tratamos seus dados pessoais em conformidade com a <strong>Lei Geral de Proteção de Dados (LGPD)</strong>.
                        </p>
                        <p><strong>Seus direitos:</strong></p>
                        <ul class="list-disc list-inside space-y-2 pl-4">
                            <li>Solicitar acesso aos seus dados pessoais</li>
                            <li>Corrigir dados incompletos ou desatualizados</li>
                            <li>Solicitar a exclusão de seus dados</li>
                            <li>Revogar o consentimento de uso de dados</li>
                            <li>Solicitar portabilidade dos seus dados</li>
                        </ul>
                        <p class="text-lime-400 font-bold mt-4">
                            Armazenamos dados apenas pelo tempo necessário para fornecer nossos serviços.
                        </p>
                    </div>
                </section>

                <!-- 4. Alterações nos Termos -->
                <section id="alteracoes" class="border-4 border-zinc-100 p-6 md:p-8 bg-zinc-900 hover:border-lime-400 transition-colors scroll-mt-24">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="flex-shrink-0 w-10 h-10 bg-lime-400 flex items-center justify-center text-zinc-950 font-black text-xl">
                            4
                        </div>
                        <h2 class="text-2xl md:text-3xl font-black uppercase">Alterações nos Termos</h2>
                    </div>
                    <div class="space-y-4 text-zinc-300 leading-relaxed">
                        <p>
                            Podemos atualizar estes termos periodicamente para refletir mudanças em nossas práticas ou por razões legais.
                        </p>
                        <p>
                            Quando houver alterações significativas, notificaremos você por e-mail ou através de um aviso na plataforma.
                        </p>
                        <p class="font-bold">
                            Ao continuar usando a plataforma após as alterações, você aceita os novos termos.
                        </p>
                    </div>
                </section>

                <!-- 5. Uso dos Dados Financeiros -->
                <section id="dados-financeiros" class="border-4 border-zinc-100 p-6 md:p-8 bg-zinc-900 hover:border-lime-400 transition-colors scroll-mt-24">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="flex-shrink-0 w-10 h-10 bg-cyan-400 flex items-center justify-center text-zinc-950 font-black text-xl">
                            5
                        </div>
                        <h2 class="text-2xl md:text-3xl font-black uppercase">Uso dos Dados Financeiros</h2>
                    </div>
                    <div class="space-y-4 text-zinc-300 leading-relaxed">
                        <div class="bg-lime-400/10 border-2 border-lime-400 p-4">
                            <p class="text-lime-400 font-bold">
                                ✓ Seus dados financeiros são privados e nunca serão compartilhados ou vendidos.
                            </p>
                        </div>
                        <p>
                            O <strong>Filament Wallet</strong> não utiliza seus dados financeiros para:
                        </p>
                        <ul class="list-disc list-inside space-y-2 pl-4">
                            <li>Publicidade direcionada</li>
                            <li>Análises de terceiros</li>
                            <li>Venda para empresas parceiras</li>
                            <li>Qualquer finalidade não autorizada por você</li>
                        </ul>
                        <p class="font-bold mt-4">
                            Todas as informações são exclusivamente visíveis para você.
                        </p>
                    </div>
                </section>

                <!-- 6. Segurança e Armazenamento -->
                <section id="seguranca" class="border-4 border-zinc-100 p-6 md:p-8 bg-zinc-900 hover:border-lime-400 transition-colors scroll-mt-24">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="flex-shrink-0 w-10 h-10 bg-fuchsia-500 flex items-center justify-center text-zinc-950 font-black text-xl">
                            6
                        </div>
                        <h2 class="text-2xl md:text-3xl font-black uppercase">Segurança e Armazenamento</h2>
                    </div>
                    <div class="space-y-4 text-zinc-300 leading-relaxed">
                        <p><strong>Medidas de segurança implementadas:</strong></p>
                        <ul class="list-disc list-inside space-y-2 pl-4">
                            <li>Criptografia de ponta a ponta para senhas</li>
                            <li>Conexões HTTPS seguras</li>
                            <li>Autenticação segura</li>
                        </ul>
                        <p class="mt-4">
                            Não compartilhamos dados com terceiros sem seu consentimento explícito, exceto quando exigido por lei.
                        </p>
                    </div>
                </section>

                <!-- 7. Limitação de Responsabilidade -->
                <section id="limitacao" class="border-4 border-zinc-100 p-6 md:p-8 bg-zinc-900 hover:border-lime-400 transition-colors scroll-mt-24">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="flex-shrink-0 w-10 h-10 bg-lime-400 flex items-center justify-center text-zinc-950 font-black text-xl">
                            7
                        </div>
                        <h2 class="text-2xl md:text-3xl font-black uppercase">Limitação de Responsabilidade</h2>
                    </div>
                    <div class="space-y-4 text-zinc-300 leading-relaxed">
                        <p>
                            O <strong>Filament Wallet</strong> é uma ferramenta de organização financeira pessoal e não oferece:
                        </p>
                        <ul class="list-disc list-inside space-y-2 pl-4">
                            <li>Consultoria financeira profissional</li>
                            <li>Recomendações de investimento</li>
                            <li>Serviços bancários ou de pagamento</li>
                            <li>Garantias de resultados financeiros</li>
                        </ul>
                        <div class="bg-zinc-800 border-2 border-zinc-700 p-4 mt-4">
                            <p class="font-bold">
                                Não nos responsabilizamos por decisões financeiras tomadas com base nas informações registradas na plataforma.
                            </p>
                        </div>
                    </div>
                </section>

                <!-- 8. Propriedade Intelectual -->
                <section id="propriedade" class="border-4 border-zinc-100 p-6 md:p-8 bg-zinc-900 hover:border-lime-400 transition-colors scroll-mt-24">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="flex-shrink-0 w-10 h-10 bg-cyan-400 flex items-center justify-center text-zinc-950 font-black text-xl">
                            8
                        </div>
                        <h2 class="text-2xl md:text-3xl font-black uppercase">Propriedade Intelectual</h2>
                    </div>
                    <div class="space-y-4 text-zinc-300 leading-relaxed">
                        <p>
                            Todo o conteúdo da plataforma, incluindo design, código, logos e textos, é propriedade do <strong>Filament Wallet</strong>.
                        </p>
                        <p>
                            Você não pode copiar, modificar, distribuir ou usar nosso conteúdo sem autorização prévia por escrito.
                        </p>
                        <p class="font-bold">
                            Seus dados financeiros e registros continuam sendo sua propriedade exclusiva.
                        </p>
                    </div>
                </section>

                <!-- 9. Cancelamento de Conta -->
                <section id="cancelamento" class="border-4 border-zinc-100 p-6 md:p-8 bg-zinc-900 hover:border-lime-400 transition-colors scroll-mt-24">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="flex-shrink-0 w-10 h-10 bg-fuchsia-500 flex items-center justify-center text-zinc-950 font-black text-xl">
                            9
                        </div>
                        <h2 class="text-2xl md:text-3xl font-black uppercase">Cancelamento de Conta</h2>
                    </div>
                    <div class="space-y-4 text-zinc-300 leading-relaxed">
                        <p>
                            Você pode cancelar sua conta a qualquer momento através das configurações da plataforma.
                        </p>
                        <p><strong>Ao cancelar sua conta:</strong></p>
                        <ul class="list-disc list-inside space-y-2 pl-4">
                            <li>Seus dados serão permanentemente excluídos em até 30 dias</li>
                            <li>Você perderá acesso a todos os registros financeiros</li>
                            <li>Não será possível recuperar os dados após a exclusão</li>
                        </ul>
                        <p class="text-lime-400 font-bold mt-4">
                            Recomendamos exportar seus dados antes de cancelar a conta.
                        </p>
                    </div>
                </section>

                <!-- 10. Contato -->
                <section id="contato" class="border-4 border-lime-400 p-6 md:p-8 bg-lime-400/10">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="flex-shrink-0 w-10 h-10 bg-lime-400 flex items-center justify-center text-zinc-950 font-black text-xl">
                            10
                        </div>
                        <h2 class="text-2xl md:text-3xl font-black uppercase text-lime-400">Contato</h2>
                    </div>
                    <div class="space-y-4 text-zinc-300 leading-relaxed">
                        <p>
                            Para dúvidas, sugestões ou exercer seus direitos sob a LGPD, entre em contato:
                        </p>
                        <div class="space-y-2 font-bold">
                            <p>📧 E-mail: <a href="mailto:suporte@filamentwallet.com" class="text-lime-400 hover:underline">suporte@filamentwallet.com</a></p>
                            <p>🌐 Site: <a href="{{ route('web.home') }}" class="text-lime-400 hover:underline">{{ config('app.url') }}</a></p>
                        </div>
                        <p class="text-sm text-zinc-400 mt-4">
                            Tempo médio de resposta: 48 horas úteis
                        </p>
                    </div>
                </section>

            </div>

            <!-- Botões de ação -->
            <div class="flex flex-col sm:flex-row gap-4 mt-12 pt-12 border-t-4 border-zinc-800">
                <a href="{{ route('web.home') }}"
                    class="inline-block bg-lime-400 text-zinc-950 px-8 py-4 font-black uppercase text-center shadow-[6px_6px_0_0_#000] hover:shadow-[2px_2px_0_0_#000] hover:-translate-x-1 hover:-translate-y-1 transition-all">
                    Voltar para o início
                </a>
                <button onclick="window.print()"
                    class="inline-block border-4 border-zinc-100 text-zinc-100 px-8 py-4 font-black uppercase text-center hover:bg-zinc-100 hover:text-zinc-950 transition-all">
                    Imprimir Termos
                </button>
            </div>

        </div>

        <!-- Footer -->
        <x-layout.footer />
    </div>
</x-layout.main-layout>