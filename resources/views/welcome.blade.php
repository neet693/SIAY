@extends('Layout.app2')

@section('content')

    {{-- =========================================================
    HOMEPAGE
    ========================================================== --}}
    <main class="sky-home">

        {{-- =====================================================
        HERO
        ====================================================== --}}
        <section class="sky-hero">

            <div class="sky-hero-frame">

                @if (!empty($banners))

                    <div id="schoolHero" class="carousel slide carousel-fade sky-carousel" data-bs-ride="carousel"
                        data-bs-interval="5000">

                        {{-- =================================================
                        SLIDES
                        ================================================== --}}
                        <div class="carousel-inner">

                            @foreach ($banners as $index => $banner)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">

                                    <div class="sky-banner">

                                        <img src="{{ $banner }}" class="sky-banner-image" alt="Sekolah Kristen Yahya"
                                            loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                                            onerror="this.closest('.carousel-item').remove();">

                                        {{-- Subtle cinematic shading --}}
                                        <div class="sky-banner-shade"></div>

                                    </div>

                                </div>
                            @endforeach

                        </div>


                        {{-- =================================================
                        NAVIGATION
                        ================================================== --}}
                        @if (count($banners) > 1)
                            <button class="sky-arrow sky-arrow-prev" type="button" data-bs-target="#schoolHero"
                                data-bs-slide="prev">

                                <span>←</span>

                            </button>

                            <button class="sky-arrow sky-arrow-next" type="button" data-bs-target="#schoolHero"
                                data-bs-slide="next">

                                <span>→</span>

                            </button>
                        @endif


                        {{-- =================================================
                        PROGRESS
                        ================================================== --}}
                        @if (count($banners) > 1)
                            <div class="sky-progress">

                                @foreach ($banners as $index => $banner)
                                    <button type="button" data-bs-target="#schoolHero"
                                        data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}">
                                    </button>
                                @endforeach

                            </div>
                        @endif

                    </div>
                @else
                    {{-- FALLBACK --}}
                    <div class="sky-empty">

                        <span>Sekolah Kristen Yahya</span>

                        <strong>
                            Selamat Datang
                        </strong>

                    </div>

                @endif


                {{-- =====================================================
                FLOATING CTA
                ====================================================== --}}
                <a href="{{ route('ppdb.create') }}" class="sky-admission">

                    <span>
                        Daftar Sekarang
                    </span>

                    <span class="sky-admission-icon">
                        ↗
                    </span>

                </a>

            </div>

        </section>



        {{-- =========================================================
        UNIT PENDIDIKAN
        ========================================================== --}}
        <section class="sky-units">

            <div class="sky-units-header">

                <div>

                    <span class="sky-kicker">
                        UNIT PENDIDIKAN
                    </span>

                    <h2>
                        Temukan
                        <span>sekolahmu.</span>
                    </h2>

                </div>

                <span class="sky-unit-count">
                    04 UNIT
                </span>

            </div>


            {{-- =====================================================
            UNIT GRID
            ====================================================== --}}
            <div class="sky-unit-grid">


                {{-- TK --}}
                <a href="{{ $unitLinks['tk'] ?? '#' }}" class="sky-unit-card">

                    <img src="{{ asset('app/assets/images/unit/tk.jpg') }}" alt="KB dan TK Sekolah Kristen Yahya"
                        loading="lazy">

                    <div class="sky-unit-shade"></div>

                    <div class="sky-unit-top">

                        <span>
                            01
                        </span>

                        <span class="sky-unit-arrow">
                            ↗
                        </span>

                    </div>

                    <div class="sky-unit-bottom">

                        <small>
                            UNIT PENDIDIKAN
                        </small>

                        <strong>
                            KB & TK
                        </strong>

                    </div>

                </a>



                {{-- SD --}}
                <a href="https://sd.sekolahyahya.sch.id/" class="sky-unit-card">

                    <img src="{{ asset('app/assets/images/unit/sd.jpg') }}" alt="SD Sekolah Kristen Yahya" loading="lazy">

                    <div class="sky-unit-shade"></div>

                    <div class="sky-unit-top">

                        <span>
                            02
                        </span>

                        <span class="sky-unit-arrow">
                            ↗
                        </span>

                    </div>

                    <div class="sky-unit-bottom">

                        <small>
                            UNIT PENDIDIKAN
                        </small>

                        <strong>
                            SD
                        </strong>

                    </div>

                </a>



                {{-- SMP --}}
                <a href="https://smp.sekolahyahya.sch.id/" class="sky-unit-card">

                    <img src="{{ asset('app/assets/images/unit/smp.jpg') }}" alt="SMP Sekolah Kristen Yahya" loading="lazy">

                    <div class="sky-unit-shade"></div>

                    <div class="sky-unit-top">

                        <span>
                            03
                        </span>

                        <span class="sky-unit-arrow">
                            ↗
                        </span>

                    </div>

                    <div class="sky-unit-bottom">

                        <small>
                            UNIT PENDIDIKAN
                        </small>

                        <strong>
                            SMP
                        </strong>

                    </div>

                </a>



                {{-- SMA --}}
                <a href="https://sma.sekolahyahya.sch.id/" class="sky-unit-card">

                    <img src="{{ asset('app/assets/images/unit/sma.jpg') }}" alt="SMA Sekolah Kristen Yahya"
                        loading="lazy">

                    <div class="sky-unit-shade"></div>

                    <div class="sky-unit-top">

                        <span>
                            04
                        </span>

                        <span class="sky-unit-arrow">
                            ↗
                        </span>

                    </div>

                    <div class="sky-unit-bottom">

                        <small>
                            UNIT PENDIDIKAN
                        </small>

                        <strong>
                            SMA
                        </strong>

                    </div>

                </a>

            </div>

        </section>

    </main>



    <style>
        /* =====================================================
                                                                                                                                       DESIGN SYSTEM
                                                                                                                                    ====================================================== */

        :root {
            --sky-blue: #2b6eff;
            --sky-text: #111;
            --sky-muted: #777;

            --unit-tk: #FEBE00;
            --unit-sd: #FF0101;
            --unit-smp: #034986;
            --unit-sma: #D5C0AA;

            --sky-radius: 18px;
        }


        /* =====================================================
                                                                                                                                       PAGE
                                                                                                                                    ====================================================== */

        .sky-home {
            height: calc(100vh - 70px);
            background: #fff;
            overflow: hidden;

            display: flex;
            flex-direction: column;
        }


        /* =====================================================
                                                                                                                                       HERO
                                                                                                                                       50% OF AVAILABLE SCREEN
                                                                                                                                    ====================================================== */

        .sky-hero {
            flex: 0 0 70%;
            min-height: 0;

            padding: 18px 18px 8px;

            display: flex;
        }

        .sky-hero-frame {
            position: relative;

            width: 100%;
            height: 100%;

            overflow: hidden;

            border-radius: 18px;

            background: #111;

            box-shadow:
                0 10px 35px rgba(0, 0, 0, .08);
        }


        .sky-carousel {
            position: relative;

            width: 100%;
            height: 100%;
        }


        .sky-carousel .carousel-inner,
        .sky-carousel .carousel-item {
            width: 100%;
            height: 100%;
        }


        /* =====================================================
                                                                                                                                       BANNER
                                                                                                                                    ====================================================== */

        .sky-banner {
            position: relative;

            width: 100%;
            height: 100%;

            overflow: hidden;

            background: #111;
        }


        .sky-banner-image {
            position: absolute;
            inset: 0;

            width: 100%;
            height: 100%;

            object-fit: contain;
            object-position: center;

            display: block;

            background: #f4f4f4;
        }


        /* subtle cinematic shade */

        .sky-banner-shade {
            position: absolute;

            inset: 0;

            pointer-events: none;

            background:
                linear-gradient(to bottom,
                    rgba(0, 0, 0, .02) 45%,
                    rgba(0, 0, 0, .22) 100%);
        }


        /* =====================================================
                                                                                                                                       ADMISSION BUTTON
                                                                                                                                    ====================================================== */

        .sky-admission {
            position: absolute;

            right: 30px;
            bottom: 28px;

            z-index: 30;

            display: flex;
            align-items: center;

            gap: 12px;

            padding:
                7px 8px 7px 19px;

            color: #fff;

            text-decoration: none;

            font-size: 12px;

            font-weight: 700;

            letter-spacing: .2px;

            border-radius: 999px;

            background:
                rgba(15, 15, 15, .68);

            border:
                1px solid rgba(255, 255, 255, .30);

            box-shadow:
                0 10px 30px rgba(0, 0, 0, .35);

            backdrop-filter:
                blur(18px) saturate(150%);

            -webkit-backdrop-filter:
                blur(18px) saturate(150%);

            transition:
                transform .25s ease,
                background .25s ease;
        }


        .sky-admission:hover {
            color: #fff;

            background:
                rgba(15, 15, 15, .82);

            transform:
                translateY(-3px);
        }


        .sky-admission-icon {
            width: 34px;
            height: 34px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #fff;

            color: #111;

            font-size: 15px;

            transition:
                transform .3s ease;
        }


        .sky-admission:hover .sky-admission-icon {
            transform:
                rotate(45deg);
        }


        /* =====================================================
                                                                                                                                       ARROWS
                                                                                                                                    ====================================================== */

        .sky-arrow {
            position: absolute;

            z-index: 20;

            top: 50%;

            width: 42px;
            height: 42px;

            transform:
                translateY(-50%);

            display: flex;
            align-items: center;
            justify-content: center;

            border:
                1px solid rgba(255, 255, 255, .22);

            border-radius: 50%;

            background:
                rgba(0, 0, 0, .25);

            backdrop-filter:
                blur(12px);

            color: #fff;

            font-size: 16px;

            transition: .25s ease;
        }


        .sky-arrow:hover {
            background: #fff;

            color: #111;

            transform:
                translateY(-50%) scale(1.05);
        }


        .sky-arrow-prev {
            left: 20px;
        }


        .sky-arrow-next {
            right: 20px;
        }


        /* =====================================================
                                                                                                                                       PROGRESS
                                                                                                                                    ====================================================== */

        .sky-progress {
            position: absolute;

            z-index: 20;

            left: 50%;
            bottom: 20px;

            transform:
                translateX(-50%);

            display: flex;
            align-items: center;

            gap: 5px;
        }


        .sky-progress button {
            width: 18px;
            height: 3px;

            padding: 0;

            border: 0;

            border-radius: 999px;

            background:
                rgba(255, 255, 255, .38);

            transition: .3s ease;
        }


        .sky-progress button.active {
            width: 38px;

            background: #fff;
        }


        /* =====================================================
                                                                                                                                       UNITS
                                                                                                                                       50% OF AVAILABLE SCREEN
                                                                                                                                    ====================================================== */

        .sky-units {
            flex: 0 0 30%;

            min-height: 0;

            padding: 8px 18px 18px;

            display: flex;
            flex-direction: column;

            overflow: hidden;
        }

        /* =====================================================
                                                                                                                                       UNIT HEADER
                                                                                                            ====================================================== */

        .sky-units-header {
            flex: 0 0 auto;

            display: flex;
            align-items: end;
            justify-content: space-between;

            margin-bottom: 10px;
        }

        .sky-kicker {
            display: block;

            color: var(--sky-blue);

            font-size: 8px;
            font-weight: 800;

            letter-spacing: 2px;
        }

        .sky-units-header h2 {
            margin: 4px 0 0;

            color: var(--sky-text);

            font-size: 25px;
            line-height: 1;

            font-weight: 750;

            letter-spacing: -1.5px;
        }


        .sky-units-header h2 span {
            color:
                var(--sky-blue);
        }


        .sky-unit-count {
            color: #999;

            font-size: 8px;
            font-weight: 700;

            letter-spacing: 1px;
        }


        /* =====================================================
                                                                                                                                       UNIT GRID
                                                                                                                                    ====================================================== */

        .sky-unit-grid {
            flex: 1;

            min-height: 0;

            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 10px;
        }


        /* =====================================================
                                                                                                                                       UNIT CARD
                                                                                        ====================================================== */
        .sky-unit-card {
            --unit-color: #0e2645;

            position: relative;

            min-height: 0;
            height: 100%;

            overflow: hidden;

            border-radius: 14px;

            background: var(--unit-color);

            color: #fff;

            text-decoration: none;

            isolation: isolate;

            box-shadow:
                0 8px 24px rgba(0, 0, 0, .12);

            transition:
                transform .3s ease,
                box-shadow .3s ease;
        }

        /* warna masing-masing unit */

        .sky-unit-card:nth-child(1) {
            --unit-color: var(--unit-tk);
        }

        .sky-unit-card:nth-child(2) {
            --unit-color: var(--unit-sd);
        }

        .sky-unit-card:nth-child(3) {
            --unit-color: var(--unit-smp);
        }

        .sky-unit-card:nth-child(4) {
            --unit-color: var(--unit-sma);
        }


        .sky-unit-card:hover {
            color: #fff;

            transform:
                translateY(-3px);

            box-shadow:
                0 14px 32px rgba(0, 0, 0, .18);
        }


        /* =====================================================
                                                                                                                                       UNIT IMAGE
                                                                                                                                    ====================================================== */

        .sky-unit-card img {
            position: absolute;

            inset: 0;

            width: 100%;
            height: 100%;

            object-fit: cover;

            opacity: .48;

            mix-blend-mode: normal;

            transition:
                transform .6s cubic-bezier(.2, .8, .2, 1),
                opacity .4s ease;
        }


        .sky-unit-card:hover img {
            transform:
                scale(1.06);

            opacity: .58;
        }


        /* =====================================================
                                                                                                                                       COLOR TREATMENT
                                                                                                                                    ====================================================== */

        .sky-unit-card::before {
            content: "";

            position: absolute;

            inset: 0;

            z-index: 1;

            background:
                linear-gradient(180deg,
                    color-mix(in srgb,
                        var(--unit-color) 65%,
                        transparent) 0%,

                    color-mix(in srgb,
                        var(--unit-color) 90%,
                        #000 10%) 100%);

            pointer-events: none;
        }


        /* =====================================================
                                                                                                                                       UNIT SHADE
                                                                                                                                    ====================================================== */

        .sky-unit-shade {
            position: absolute;

            inset: 0;

            z-index: 2;

            background:
                linear-gradient(to bottom,
                    rgba(0, 0, 0, .02),
                    rgba(0, 0, 0, .18));

            pointer-events: none;
        }


        /* =====================================================
                                                                                                                                       UNIT TOP
                                                                                                                                    ====================================================== */

        .sky-unit-top {
            position: absolute;

            z-index: 4;

            top: 11px;

            left: 12px;
            right: 12px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            color:
                rgba(255, 255, 255, .82);

            font-size: 9px;

            font-weight: 700;
        }


        .sky-unit-arrow {
            width: 28px;
            height: 28px;

            display: flex;

            align-items: center;
            justify-content: center;

            border:
                1px solid rgba(255, 255, 255, .35);

            border-radius: 50%;

            background:
                rgba(0, 0, 0, .10);

            backdrop-filter:
                blur(8px);

            transition: .3s ease;
        }


        .sky-unit-card:hover .sky-unit-arrow {
            background: #fff;

            color: #111;

            transform:
                rotate(45deg);
        }


        /* =====================================================
                                                                                                                                       UNIT BOTTOM
                                                                                                                                    ====================================================== */

        .sky-unit-bottom {
            position: absolute;

            z-index: 4;

            left: 14px;
            right: 14px;

            bottom: 14px;
        }


        .sky-unit-bottom small {
            display: block;

            margin-bottom: 4px;

            color:
                rgba(255, 255, 255, .68);

            font-size: 7px;

            font-weight: 700;

            letter-spacing: 1.5px;
        }


        .sky-unit-bottom strong {
            display: block;

            color: #fff;

            font-size: 21px;

            line-height: 1;

            font-weight: 750;

            letter-spacing: -.5px;
        }

        .sky-empty {
            width: 100%;
            height: 100%;

            display: flex;

            flex-direction: column;

            align-items: center;
            justify-content: center;

            background:
                linear-gradient(135deg,
                    #151515,
                    #282828);

            color: #fff;
        }


        .sky-empty span {
            color: #aaa;

            font-size: 10px;

            letter-spacing: 2px;

            text-transform: uppercase;
        }


        .sky-empty strong {
            margin-top: 10px;

            font-size: 35px;
        }


        /* =====================================================
                                                                                                                                       LAPTOP / SHORT SCREEN
                                                                                                                                    ====================================================== */

        @media (min-width: 992px) and (max-height: 800px) {

            .sky-home {
                min-height: 0;
            }

            .sky-hero {
                padding-top: 14px;
                padding-bottom: 7px;
            }

            .sky-units {
                padding-top: 7px;
                padding-bottom: 14px;
            }

            .sky-units-header {
                margin-bottom: 9px;
            }

            .sky-units-header h2 {
                font-size: 24px;
            }

            .sky-unit-bottom {
                bottom: 11px;
            }

            .sky-unit-bottom strong {
                font-size: 18px;
            }
        }


        /* =====================================================
                                                                                                                                       TABLET
                                                                                                                                    ====================================================== */

        @media (max-width: 991px) {

            .sky-home {
                height: auto;

                min-height: 100vh;

                overflow: visible;
            }


            .sky-hero {
                flex: none;

                height: 50vh;

                min-height: 400px;
            }


            .sky-units {
                flex: none;

                height: auto;

                padding-bottom: 25px;

                overflow: visible;
            }


            .sky-unit-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }


            .sky-unit-card {
                height: 160px;
            }
        }


        /* =====================================================
                                                                                                                                       MOBILE
                                                                                                                                    ====================================================== */

        @media (max-width: 768px) {

            .sky-home {
                min-height: 100vh;

                height: auto;
            }


            .sky-hero {
                height: 48vh;

                min-height: 330px;

                padding:
                    10px 10px 5px;
            }


            .sky-hero-frame {
                border-radius: 15px;
            }


            .sky-admission {
                left: 18px;
                right: 18px;

                bottom: 18px;

                justify-content:
                    space-between;
            }


            .sky-arrow {
                width: 36px;
                height: 36px;
            }


            .sky-arrow-prev {
                left: 10px;
            }


            .sky-arrow-next {
                right: 10px;
            }


            .sky-progress {
                bottom: 18px;
            }


            .sky-units {
                height: auto;

                padding:
                    10px 10px 20px;
            }


            .sky-units-header {
                margin-bottom: 10px;
            }


            .sky-units-header h2 {
                font-size: 24px;
            }


            .sky-unit-grid {
                gap: 8px;
            }


            .sky-unit-card {
                height: 145px;

                border-radius: 11px;
            }


            .sky-unit-bottom {
                left: 11px;
                right: 11px;
                bottom: 11px;
            }


            .sky-unit-bottom strong {
                font-size: 17px;
            }
        }


        /* =====================================================
                                                                                                                                       VERY SMALL MOBILE
                                                                                                                                    ====================================================== */

        @media (max-width: 480px) {

            .sky-hero {
                height: 45vh;

                min-height: 300px;
            }


            .sky-unit-card {
                height: 125px;
            }


            .sky-unit-bottom strong {
                font-size: 15px;
            }
        }
    </style>

@endsection
