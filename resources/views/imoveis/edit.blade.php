@extends('layouts.layout_navbar')

@section('title','Detalhe Produto')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/produto.css') }}">

    <script src="{{ asset('js/mostrar-interesse.js') }}"></script>
    <script src="{{ asset('js/caroselDetalhe.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">

    <button id="mostrar" onclick="changeVisibility()">Tenho interesse!</button>

    <div id="pagina-layout">

        <section id="interesse" class="margin-spaced padding-spaced">
            <div id="fechar-icone-container" onclick="changeVisibility()">
                <img src="{{ asset('img/fechar-icone.svg') }}" alt="" id="fechar-icone">
            </div>
            <div id="interesse-contato-container" class="flex-center-center-column">
                <h1>Se interessou pelo imóvel? fale conosco!</h1>
                <input type="text" id="interesse-contato-nome" class="interesse-contato-input" placeholder="Nome">
                <input type="text" id="interesse-contato-telefone" class="interesse-contato-input" placeholder="Telefone">
                <input type="text" id="interesse-contato-email" class="interesse-contato-input" placeholder="Email">
                <textarea name="" id="interesse-contato-texto" cols="30" rows="10" class="interesse-contato-input" placeholder="Texto (opcional)" res></textarea>
                <button id="interesse-btn">Enviar</button>
            </div>
        </section>
        <!-- <div class="produto-info-box">

            </div> -->
            <div id="produto-layout">
                <section id="imovel-info-main" class="flex-center-center-column margin-spaced padding-spaced">
                    <h1>{{ $detalhes->titulo }} {{ $detalhes->id}}</h1>
                    <div id="produto-carrossel" class="flex-center-center slider-for">
                        @foreach ($imagens as $index => $path)
                            @if($detalhes->id == $path->chave)
                                <div><div class="carrossel-img-frame img" style="background-image: url('{{asset($path->path)}}')"></div></div>
                            @endif
                        @endforeach
                    </div>

                    <div id="produto-carrossel-nav" class="flex-center-center slider-nav">
                        @foreach ($imagens as $index => $path)
                            @if($detalhes->id == $path->chave)
                                <div><div class="carrossel-img-frame img-nav" style="background-image: url('{{asset($path->path)}}')"></div></div>
                            @endif
                        @endforeach
                    </div>

                    <div id="imovel-dados" class="flex-row">
                        <h2 id="valor">R${{ $detalhes->valor }}</h2>
                    </div>
                </section>

                <section id="descricao" >
                    <div id="descricao-container" class="margin-spaced padding-spaced">
                        <h2 class="detalhes-titulo">Tipo de contrato</h2>
                        <p id="desc-texto">{{ $detalhes->tp_contrato }}</p>
                    </div>
                    <div id="descricao-container" class="margin-spaced padding-spaced">
                        <h2 class="detalhes-titulo">Descrição do produto</h2>
                        <p id="desc-texto">{{ $detalhes->desc }}</p>
                    </div>
                    <div id="descricao-container" class="margin-spaced padding-spaced">
                        <h2 class="detalhes-titulo">Localização</h2>
                        <p id="desc-texto">{{ $detalhes->localidade }}</p>
                    </div>

                    <div id="descricao-container" class="margin-spaced padding-spaced">
                        <h2 class="detalhes-titulo">Informações sobre área</h2>

                        <div class="area-container">
                            <div class="area-content">
                                <p id="area">Área total: {{ $detalhes->area }} m²</p>
                            </div>
                            <div class="area-content">
                                <p id="area">Área útil: {{ $detalhes->areaUtil }} m²</p>
                            </div>

                            <div class="area-content">
                                <p id="area">Área do terreno: {{ $detalhes->areaTerreno }} m²</p>
                            </div>

                            <div class="area-content">
                                <p id="area">Área construída: {{ $detalhes->areaConstruida }} m²</p>
                            </div>
                            <div class="area-content">
                            </div>
                        </div>
                    </div>

                    <div id="descricao-container" class="margin-spaced padding-spaced">
                        <h2 class="detalhes-titulo">Valores</h2>

                        <div class="area-container">
                            <div class="area-content">
                                <p>Condomínio: R${{ $detalhes->valorCondominio }}</p>
                            </div>
                            <div class="area-content">
                                <p>IPTU mensal: R${{ $detalhes->iptuMensal }}</p>
                            </div>
                        </div>

                    </div>

                    <div id="descricao-container" class="margin-spaced padding-spaced">
                        <h2 class="detalhes-titulo">Acomodações</h2>
                        <div class="area-container">
                            <div class="area-content">
                                <p id="quartos">{{ $detalhes->qtdQuartos }} quarto(s)</p>
                            </div>
                            <div class="area-content">
                                <p id="quartos">{{ $detalhes->qtdBanheiros }} banheiro(s)</p>
                            </div>
                            <div class="area-content">
                                <p id="quartos"> {{ $detalhes->qtdSuites }} suite(s)</p>
                            </div>
                            <div class="area-content">
                                <p id="quartos">{{ $detalhes->qtdVagas }} vaga(s)</p>
                            </div>
                        </div>
                    </div>

                </section>

                @if ($detalhes->descricao != 'Terreno')
                    <section id="mais-detalhes" class="margin-spaced padding-spaced">
                        <h2 class="detalhes-titulo">Mais detalhes</h2>
                        <div id="mais-detalhes-container">
                            @if($detalhes->agua == 1 or $detalhes->esgoto == 1 or $detalhes->energia == 1
                                or $detalhes->murado == 1 or $detalhes->pavimentação == 1)
                                <h3>Básico</h3>
                                <div class="area-container">
                                    @if($detalhes->agua == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Agua</p>
                                        </div>
                                    @endif

                                    @if($detalhes->esgoto == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Esgoto</p>
                                        </div>
                                    @endif

                                    @if($detalhes->energia == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Energia</p>
                                        </div>
                                    @endif

                                    @if($detalhes->murado == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Murado</p>
                                        </div>
                                    @endif

                                    @if($detalhes->pavimentação == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Pavimentação</p>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            @if($detalhes->areaServico == 1 or $detalhes->banheiroAuxiliar == 1 or $detalhes->banheiroEmpregada == 1
                                or $detalhes->cozinha == 1 or $detalhes->cozinhaPlanejada == 1 or $detalhes->despensa == 1
                                or $detalhes->lavanderias == 1 or $detalhes->guarita == 1 or $detalhes->portaria24h == 1)
                                <h3>Serviços</h3>

                                <div class="area-container">
                                    @if($detalhes->areaServico == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Area de Serviço</p>
                                        </div>
                                    @endif

                                    @if($detalhes->banheiroAuxiliar == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Banheiro Auxiliar</p>
                                        </div>
                                    @endif

                                    @if($detalhes->banheiroEmpregada == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Banheiro Empregada</p>
                                        </div>
                                    @endif

                                    @if($detalhes->cozinha == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Cozinha</p>
                                        </div>
                                    @endif

                                    @if($detalhes->cozinhaPlanejada == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Cozinha Planejada</p>
                                        </div>
                                    @endif

                                    @if($detalhes->despensa == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Despensa</p>
                                        </div>
                                    @endif

                                    @if($detalhes->lavanderias == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Lavanderia</p>
                                        </div>
                                    @endif

                                    @if($detalhes->guarita == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Guarita</p>
                                        </div>
                                    @endif

                                    @if($detalhes->portaria24h == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Portaria 24h</p>
                                        </div>
                                    @endif

                                </div>
                            @endif

                            @if($detalhes->areaLazer == 1 or $detalhes->churrasqueira == 1 or $detalhes->playground == 1 or $detalhes->quadra == 1)
                                <h3>Lazer</h3>
                                <div class="area-container">
                                    @if($detalhes->areaLazer == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Area de Lazer</p>
                                        </div>
                                    @endif

                                    @if($detalhes->churrasqueira == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Churrasqueira</p>
                                        </div>
                                    @endif

                                    @if($detalhes->playground == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Playground</p>
                                        </div>
                                    @endif

                                    @if($detalhes->quadra == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Quadra</p>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            @if($detalhes->varanda == 1 or $detalhes->varandaGourmet)
                                <h3>Social</h3>
                                <div class="area-container">
                                    @if($detalhes->varanda == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Varanda</p>
                                        </div>
                                    @endif

                                    @if($detalhes->varandaGourmet == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Varanda Gourmet</p>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            @if($detalhes->lavado == 1 or $detalhes->roupeiro == 1 or $detalhes->suiteMaster == 1 or $detalhes->closet == 1)
                                <h3>Intima</h3>
                                <div class="area-container">
                                    @if($detalhes->lavado == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Lavado</p>
                                        </div>
                                    @endif

                                    @if($detalhes->roupeiro == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Roupeiro</p>
                                        </div>
                                    @endif

                                    @if($detalhes->suiteMaster == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Suite Master</p>
                                        </div>
                                    @endif

                                    @if($detalhes->closet == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Closet</p>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            @if($detalhes->pisoFrio == 1 or $detalhes->porcelanato == 1)
                                <h3>Acabamento</h3>
                                <div class="area-container">
                                    @if($detalhes->pisoFrio == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Piso frio</p>
                                        </div>
                                    @endif

                                    @if($detalhes->porcelanato == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Porcelanato</p>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            @if($detalhes->entradaServico == 1 or $detalhes->escritorio == 1 or $detalhes->jardim == 1 or $detalhes->moveisPlanejados == 1
                                or $detalhes->portaoEletronico == 1 or $detalhes->quintal == 1)
                                <h3>Destaque</h3>
                                <div class="area-container">
                                    @if($detalhes->entradaServico == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Entrada de serviço</p>
                                        </div>
                                    @endif

                                    @if($detalhes->escritorio == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Escritorio</p>
                                        </div>
                                    @endif

                                    @if($detalhes->jardim == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Jardim</p>
                                        </div>
                                    @endif

                                    @if($detalhes->moveisPlanejados == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Moveis Planejados</p>
                                        </div>
                                    @endif

                                    @if($detalhes->portaoEletronico == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Portão eletronico</p>
                                        </div>
                                    @endif

                                    @if($detalhes->quintal == 1)
                                        <div class="area-content">
                                            <p class="p-align-icon"><span class="material-symbols-outlined">check_circle</span>Quintal</p>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </section>
                @endif

                <section id="semelhantes" class="margin-spaced padding-spaced">
                    <div id="semelhante-container">
                        <h1 class="detalhes-titulo">Conheça semelhantes</h1>
                    @if($semelhante)
                        @foreach( $semelhante as $sem )
                            <div id="semelhante-produtos-itens">
                                <div class="semelhante-produto-card">
                                    @foreach ($imagemPrincipal as $path)
                                        @if($sem->id == $path->chave)
                                            <div class="img-semelhante" style="background-image: url('{{ asset($path->path) }}')"></div>
                                        @endif
                                    @endforeach
                                    <p class="semelhante-produto-titulo">{{ $sem->titulo }}</p>
                                    <p class="semelhante-produto-localidade">{{ $sem->localidade }}</p>
                                    <div id="semelhante-produto-info" class="flex-row">
                                        <p class="semelhante-produto-area">{{ $sem->area }}m²</p>
                                        <p class="semelhante-produto-vagas">R${{ $sem->valor }},00</p>
                                    </div>
                                    <form action="/imoveis/{{ $sem->id }}" method="post">
                                        @csrf
                                        <input type="hidden" name="idImovel">
                                        <button class="produto-saber-mais" type="submit">Detalhes</button>
                                    </form>

                                </div>
                        @endforeach
                    @endif
                </section>
            </div>
    </div>

@endsection
