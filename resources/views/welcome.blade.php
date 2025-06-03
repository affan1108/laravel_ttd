<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        /* ! tailwindcss v3.2.4 | MIT License | https://tailwindcss.com */
        *,
        ::after,
        ::before {
            box-sizing: border-box;
            border-width: 0;
            border-style: solid;
            border-color: #e5e7eb
        }

        ::after,
        ::before {
            --tw-content: ''
        }

        html {
            line-height: 1.5;
            -webkit-text-size-adjust: 100%;
            -moz-tab-size: 4;
            tab-size: 4;
            font-family: Figtree, sans-serif;
            font-feature-settings: normal
        }

        body {
            margin: 0;
            line-height: inherit
        }

        hr {
            height: 0;
            color: inherit;
            border-top-width: 1px
        }

        abbr:where([title]) {
            -webkit-text-decoration: underline dotted;
            text-decoration: underline dotted
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-size: inherit;
            font-weight: inherit
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        b,
        strong {
            font-weight: bolder
        }

        code,
        kbd,
        pre,
        samp {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-size: 1em
        }

        small {
            font-size: 80%
        }

        sub,
        sup {
            font-size: 75%;
            line-height: 0;
            position: relative;
            vertical-align: baseline
        }

        sub {
            bottom: -.25em
        }

        sup {
            top: -.5em
        }

        table {
            text-indent: 0;
            border-color: inherit;
            border-collapse: collapse
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            font-family: inherit;
            font-size: 100%;
            font-weight: inherit;
            line-height: inherit;
            color: inherit;
            margin: 0;
            padding: 0
        }

        button,
        select {
            text-transform: none
        }

        [type=button],
        [type=reset],
        [type=submit],
        button {
            -webkit-appearance: button;
            background-color: transparent;
            background-image: none
        }

        :-moz-focusring {
            outline: auto
        }

        :-moz-ui-invalid {
            box-shadow: none
        }

        progress {
            vertical-align: baseline
        }

        ::-webkit-inner-spin-button,
        ::-webkit-outer-spin-button {
            height: auto
        }

        [type=search] {
            -webkit-appearance: textfield;
            outline-offset: -2px
        }

        ::-webkit-search-decoration {
            -webkit-appearance: none
        }

        ::-webkit-file-upload-button {
            -webkit-appearance: button;
            font: inherit
        }

        summary {
            display: list-item
        }

        blockquote,
        dd,
        dl,
        figure,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        hr,
        p,
        pre {
            margin: 0
        }

        fieldset {
            margin: 0;
            padding: 0
        }

        legend {
            padding: 0
        }

        menu,
        ol,
        ul {
            list-style: none;
            margin: 0;
            padding: 0
        }

        textarea {
            resize: vertical
        }

        input::placeholder,
        textarea::placeholder {
            opacity: 1;
            color: #9ca3af
        }

        [role=button],
        button {
            cursor: pointer
        }

        :disabled {
            cursor: default
        }

        audio,
        canvas,
        embed,
        iframe,
        img,
        object,
        svg,
        video {
            display: block;
            vertical-align: middle
        }

        img,
        video {
            max-width: 100%;
            height: auto
        }

        [hidden] {
            display: none
        }

        *,
        ::before,
        ::after {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia:
        }

        ::-webkit-backdrop {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia:
        }

        ::backdrop {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia:
        }

        .relative {
            position: relative
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .mx-6 {
            margin-left: 1.5rem;
            margin-right: 1.5rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        .mt-16 {
            margin-top: 4rem
        }

        .mt-6 {
            margin-top: 1.5rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .mr-1 {
            margin-right: 0.25rem
        }

        .flex {
            display: flex
        }

        .inline-flex {
            display: inline-flex
        }

        .grid {
            display: grid
        }

        .h-16 {
            height: 4rem
        }

        .h-7 {
            height: 1.75rem
        }

        .h-6 {
            height: 1.5rem
        }

        .h-5 {
            height: 1.25rem
        }

        .min-h-screen {
            min-height: 100vh
        }

        .w-auto {
            width: auto
        }

        .w-16 {
            width: 4rem
        }

        .w-7 {
            width: 1.75rem
        }

        .w-6 {
            width: 1.5rem
        }

        .w-5 {
            width: 1.25rem
        }

        .max-w-7xl {
            max-width: 80rem
        }

        .shrink-0 {
            flex-shrink: 0
        }

        .scale-100 {
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr))
        }

        .items-center {
            align-items: center
        }

        .justify-center {
            justify-content: center
        }

        .gap-6 {
            gap: 1.5rem
        }

        .gap-4 {
            gap: 1rem
        }

        .self-center {
            align-self: center
        }

        .rounded-lg {
            border-radius: 0.5rem
        }

        .rounded-full {
            border-radius: 9999px
        }

        .bg-gray-100 {
            --tw-bg-opacity: 1;
            background-color: rgb(243 244 246 / var(--tw-bg-opacity))
        }

        .bg-white {
            --tw-bg-opacity: 1;
            background-color: rgb(255 255 255 / var(--tw-bg-opacity))
        }

        .bg-red-50 {
            --tw-bg-opacity: 1;
            background-color: rgb(254 242 242 / var(--tw-bg-opacity))
        }

        .bg-dots-darker {
            background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E")
        }

        .from-gray-700\/50 {
            --tw-gradient-from: rgb(55 65 81 / 0.5);
            --tw-gradient-to: rgb(55 65 81 / 0);
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to)
        }

        .via-transparent {
            --tw-gradient-to: rgb(0 0 0 / 0);
            --tw-gradient-stops: var(--tw-gradient-from), transparent, var(--tw-gradient-to)
        }

        .bg-center {
            background-position: center
        }

        .stroke-red-500 {
            stroke: #ef4444
        }

        .stroke-gray-400 {
            stroke: #9ca3af
        }

        .p-6 {
            padding: 1.5rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .text-center {
            text-align: center
        }

        .text-right {
            text-align: right
        }

        .text-xl {
            font-size: 1.25rem;
            line-height: 1.75rem
        }

        .text-sm {
            font-size: 0.875rem;
            line-height: 1.25rem
        }

        .font-semibold {
            font-weight: 600
        }

        .leading-relaxed {
            line-height: 1.625
        }

        .text-gray-600 {
            --tw-text-opacity: 1;
            color: rgb(75 85 99 / var(--tw-text-opacity))
        }

        .text-gray-900 {
            --tw-text-opacity: 1;
            color: rgb(17 24 39 / var(--tw-text-opacity))
        }

        .text-gray-500 {
            --tw-text-opacity: 1;
            color: rgb(107 114 128 / var(--tw-text-opacity))
        }

        .underline {
            -webkit-text-decoration-line: underline;
            text-decoration-line: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .shadow-2xl {
            --tw-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25);
            --tw-shadow-colored: 0 25px 50px -12px var(--tw-shadow-color);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
        }

        .shadow-gray-500\/20 {
            --tw-shadow-color: rgb(107 114 128 / 0.2);
            --tw-shadow: var(--tw-shadow-colored)
        }

        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms
        }

        .selection\:bg-red-500 *::selection {
            --tw-bg-opacity: 1;
            background-color: rgb(239 68 68 / var(--tw-bg-opacity))
        }

        .selection\:text-white *::selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity))
        }

        .selection\:bg-red-500::selection {
            --tw-bg-opacity: 1;
            background-color: rgb(239 68 68 / var(--tw-bg-opacity))
        }

        .selection\:text-white::selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity))
        }

        .hover\:text-gray-900:hover {
            --tw-text-opacity: 1;
            color: rgb(17 24 39 / var(--tw-text-opacity))
        }

        .hover\:text-gray-700:hover {
            --tw-text-opacity: 1;
            color: rgb(55 65 81 / var(--tw-text-opacity))
        }

        .focus\:rounded-sm:focus {
            border-radius: 0.125rem
        }

        .focus\:outline:focus {
            outline-style: solid
        }

        .focus\:outline-2:focus {
            outline-width: 2px
        }

        .focus\:outline-red-500:focus {
            outline-color: #ef4444
        }

        .group:hover .group-hover\:stroke-gray-600 {
            stroke: #4b5563
        }

        .z-10 {
            z-index: 10
        }

        @media (prefers-reduced-motion: no-preference) {
            .motion-safe\:hover\:scale-\[1\.01\]:hover {
                --tw-scale-x: 1.01;
                --tw-scale-y: 1.01;
                transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
            }
        }

        @media (prefers-color-scheme: dark) {
            .dark\:bg-gray-900 {
                --tw-bg-opacity: 1;
                background-color: rgb(17 24 39 / var(--tw-bg-opacity))
            }

            .dark\:bg-gray-800\/50 {
                background-color: rgb(31 41 55 / 0.5)
            }

            .dark\:bg-red-800\/20 {
                background-color: rgb(153 27 27 / 0.2)
            }

            .dark\:bg-dots-lighter {
                background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E")
            }

            .dark\:bg-gradient-to-bl {
                background-image: linear-gradient(to bottom left, var(--tw-gradient-stops))
            }

            .dark\:stroke-gray-600 {
                stroke: #4b5563
            }

            .dark\:text-gray-400 {
                --tw-text-opacity: 1;
                color: rgb(156 163 175 / var(--tw-text-opacity))
            }

            .dark\:text-white {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity))
            }

            .dark\:shadow-none {
                --tw-shadow: 0 0 #0000;
                --tw-shadow-colored: 0 0 #0000;
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
            }

            .dark\:ring-1 {
                --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
                --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
                box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
            }

            .dark\:ring-inset {
                --tw-ring-inset: inset
            }

            .dark\:ring-white\/5 {
                --tw-ring-color: rgb(255 255 255 / 0.05)
            }

            .dark\:hover\:text-white:hover {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity))
            }

            .group:hover .dark\:group-hover\:stroke-gray-400 {
                stroke: #9ca3af
            }
        }

        @media (min-width: 640px) {
            .sm\:fixed {
                position: fixed
            }

            .sm\:top-0 {
                top: 0px
            }

            .sm\:right-0 {
                right: 0px
            }

            .sm\:ml-0 {
                margin-left: 0px
            }

            .sm\:flex {
                display: flex
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-center {
                justify-content: center
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width: 768px) {
            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width: 1024px) {
            .lg\:gap-8 {
                gap: 2rem
            }

            .lg\:p-8 {
                padding: 2rem
            }
        }

    </style>
</head>

<body class="antialiased">
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            @auth
            <a href="{{ url('/dashboard') }}"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
            @else
            <a href="{{ route('login') }}"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}"
                class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Quick Example</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">File input</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="exampleInputFile">
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                          <span class="input-group-text">Upload</span>
                        </div>
                      </div>
                    </div>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->

              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Different Styles</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <h4>Input</h4>
                  <div class="form-group">
                    <label for="exampleInputBorder">Bottom Border only <code>.form-control-border</code></label>
                    <input type="text" class="form-control form-control-border" id="exampleInputBorder"
                      placeholder=".form-control-border">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputBorderWidth2">Bottom Border only 2px Border
                      <code>.form-control-border.border-width-2</code></label>
                    <input type="text" class="form-control form-control-border border-width-2"
                      id="exampleInputBorderWidth2" placeholder=".form-control-border.border-width-2">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputRounded0">Flat <code>.rounded-0</code></label>
                    <input type="text" class="form-control rounded-0" id="exampleInputRounded0"
                      placeholder=".rounded-0">
                  </div>
                  <h4>Custom Select</h4>
                  <div class="form-group">
                    <label for="exampleSelectBorder">Bottom Border only <code>.form-control-border</code></label>
                    <select class="custom-select form-control-border" id="exampleSelectBorder">
                      <option>Value 1</option>
                      <option>Value 2</option>
                      <option>Value 3</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleSelectBorderWidth2">Bottom Border only
                      <code>.form-control-border.border-width-2</code></label>
                    <select class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2">
                      <option>Value 1</option>
                      <option>Value 2</option>
                      <option>Value 3</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleSelectRounded0">Flat <code>.rounded-0</code></label>
                    <select class="custom-select rounded-0" id="exampleSelectRounded0">
                      <option>Value 1</option>
                      <option>Value 2</option>
                      <option>Value 3</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

              <!-- Input addon -->
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Input Addon</h3>
                </div>
                <div class="card-body">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">@</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Username">
                  </div>

                  <div class="input-group mb-3">
                    <input type="text" class="form-control">
                    <div class="input-group-append">
                      <span class="input-group-text">.00</span>
                    </div>
                  </div>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">$</span>
                    </div>
                    <input type="text" class="form-control">
                    <div class="input-group-append">
                      <span class="input-group-text">.00</span>
                    </div>
                  </div>

                  <h4>With icons</h4>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input type="email" class="form-control" placeholder="Email">
                  </div>

                  <div class="input-group mb-3">
                    <input type="text" class="form-control">
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-check"></i></span>
                    </div>
                  </div>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fas fa-dollar-sign"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control">
                    <div class="input-group-append">
                      <div class="input-group-text"><i class="fas fa-ambulance"></i></div>
                    </div>
                  </div>

                  <h5 class="mt-4 mb-2">With checkbox and radio inputs</h5>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <input type="checkbox">
                          </span>
                        </div>
                        <input type="text" class="form-control">
                      </div>
                      <!-- /input-group -->
                    </div>
                    <!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><input type="radio"></span>
                        </div>
                        <input type="text" class="form-control">
                      </div>
                      <!-- /input-group -->
                    </div>
                    <!-- /.col-lg-6 -->
                  </div>
                  <!-- /.row -->

                  <h5 class="mt-4 mb-2">With buttons</h5>

                  <p>Large: <code>.input-group.input-group-lg</code></p>

                  <div class="input-group input-group-lg mb-3">
                    <div class="input-group-prepend">
                      <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                        Action
                      </button>
                      <ul class="dropdown-menu">
                        <li class="dropdown-item"><a href="#">Action</a></li>
                        <li class="dropdown-item"><a href="#">Another action</a></li>
                        <li class="dropdown-item"><a href="#">Something else here</a></li>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item"><a href="#">Separated link</a></li>
                      </ul>
                    </div>
                    <!-- /btn-group -->
                    <input type="text" class="form-control">
                  </div>
                  <!-- /input-group -->

                  <p>Normal</p>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <button type="button" class="btn btn-danger">Action</button>
                    </div>
                    <!-- /btn-group -->
                    <input type="text" class="form-control">
                  </div>
                  <!-- /input-group -->

                  <p>Small <code>.input-group.input-group-sm</code></p>
                  <div class="input-group input-group-sm">
                    <input type="text" class="form-control">
                    <span class="input-group-append">
                      <button type="button" class="btn btn-info btn-flat">Go!</button>
                    </span>
                  </div>
                  <!-- /input-group -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <!-- Horizontal Form -->
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Horizontal Form</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal">
                  <div class="card-body">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="exampleCheck2">
                          <label class="form-check-label" for="exampleCheck2">Remember me</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-info">Sign in</button>
                    <button type="submit" class="btn btn-default float-right">Cancel</button>
                  </div>
                  <!-- /.card-footer -->
                </form>
              </div>
              <!-- /.card -->

            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">
              <!-- Form Element sizes -->
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Different Height</h3>
                </div>
                <div class="card-body">
                  <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg">
                  <br>
                  <input class="form-control" type="text" placeholder="Default input">
                  <br>
                  <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm">
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

              <div class="card card-danger">
                <div class="card-header">
                  <h3 class="card-title">Different Width</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-3">
                      <input type="text" class="form-control" placeholder=".col-3">
                    </div>
                    <div class="col-4">
                      <input type="text" class="form-control" placeholder=".col-4">
                    </div>
                    <div class="col-5">
                      <input type="text" class="form-control" placeholder=".col-5">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->

              <!-- general form elements disabled -->
              <div class="card card-warning">
                <div class="card-header">
                  <h3 class="card-title">General Elements</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form>
                    <div class="row">
                      <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Text</label>
                          <input type="text" class="form-control" placeholder="Enter ...">
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Text Disabled</label>
                          <input type="text" class="form-control" placeholder="Enter ..." disabled>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <!-- textarea -->
                        <div class="form-group">
                          <label>Textarea</label>
                          <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Textarea Disabled</label>
                          <textarea class="form-control" rows="3" placeholder="Enter ..." disabled></textarea>
                        </div>
                      </div>
                    </div>

                    <!-- input states -->
                    <div class="form-group">
                      <label class="col-form-label" for="inputSuccess"><i class="fas fa-check"></i> Input with
                        success</label>
                      <input type="text" class="form-control is-valid" id="inputSuccess" placeholder="Enter ...">
                    </div>
                    <div class="form-group">
                      <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i> Input with
                        warning</label>
                      <input type="text" class="form-control is-warning" id="inputWarning" placeholder="Enter ...">
                    </div>
                    <div class="form-group">
                      <label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i> Input with
                        error</label>
                      <input type="text" class="form-control is-invalid" id="inputError" placeholder="Enter ...">
                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <!-- checkbox -->
                        <div class="form-group">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">Checkbox</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" checked>
                            <label class="form-check-label">Checkbox checked</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" disabled>
                            <label class="form-check-label">Checkbox disabled</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <!-- radio -->
                        <div class="form-group">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio1">
                            <label class="form-check-label">Radio</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio1" checked>
                            <label class="form-check-label">Radio checked</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" disabled>
                            <label class="form-check-label">Radio disabled</label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">
                          <label>Select</label>
                          <select class="form-control">
                            <option>option 1</option>
                            <option>option 2</option>
                            <option>option 3</option>
                            <option>option 4</option>
                            <option>option 5</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Select Disabled</label>
                          <select class="form-control" disabled>
                            <option>option 1</option>
                            <option>option 2</option>
                            <option>option 3</option>
                            <option>option 4</option>
                            <option>option 5</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <!-- Select multiple-->
                        <div class="form-group">
                          <label>Select Multiple</label>
                          <select multiple class="form-control">
                            <option>option 1</option>
                            <option>option 2</option>
                            <option>option 3</option>
                            <option>option 4</option>
                            <option>option 5</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Select Multiple Disabled</label>
                          <select multiple class="form-control" disabled>
                            <option>option 1</option>
                            <option>option 2</option>
                            <option>option 3</option>
                            <option>option 4</option>
                            <option>option 5</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <!-- general form elements disabled -->
              <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Custom Elements</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form>
                    <div class="row">
                      <div class="col-sm-6">
                        <!-- checkbox -->
                        <div class="form-group">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1">
                            <label for="customCheckbox1" class="custom-control-label">Custom Checkbox</label>
                          </div>
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox2" checked>
                            <label for="customCheckbox2" class="custom-control-label">Custom Checkbox checked</label>
                          </div>
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox3" disabled>
                            <label for="customCheckbox3" class="custom-control-label">Custom Checkbox disabled</label>
                          </div>
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input custom-control-input-danger" type="checkbox"
                              id="customCheckbox4" checked>
                            <label for="customCheckbox4" class="custom-control-label">Custom Checkbox with custom
                              color</label>
                          </div>
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input custom-control-input-danger custom-control-input-outline"
                              type="checkbox" id="customCheckbox5" checked>
                            <label for="customCheckbox5" class="custom-control-label">Custom Checkbox with custom color
                              outline</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <!-- radio -->
                        <div class="form-group">
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="customRadio1" name="customRadio">
                            <label for="customRadio1" class="custom-control-label">Custom Radio</label>
                          </div>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio"
                              checked>
                            <label for="customRadio2" class="custom-control-label">Custom Radio checked</label>
                          </div>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="customRadio3" disabled>
                            <label for="customRadio3" class="custom-control-label">Custom Radio disabled</label>
                          </div>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input custom-control-input-danger" type="radio"
                              id="customRadio4" name="customRadio2" checked>
                            <label for="customRadio4" class="custom-control-label">Custom Radio with custom
                              color</label>
                          </div>
                          <div class="custom-control custom-radio">
                            <input class="custom-control-input custom-control-input-danger custom-control-input-outline"
                              type="radio" id="customRadio5" name="customRadio2">
                            <label for="customRadio5" class="custom-control-label">Custom Radio with custom color
                              outline</label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">
                          <label>Custom Select</label>
                          <select class="custom-select">
                            <option>option 1</option>
                            <option>option 2</option>
                            <option>option 3</option>
                            <option>option 4</option>
                            <option>option 5</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Custom Select Disabled</label>
                          <select class="custom-select" disabled>
                            <option>option 1</option>
                            <option>option 2</option>
                            <option>option 3</option>
                            <option>option 4</option>
                            <option>option 5</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <!-- Select multiple-->
                        <div class="form-group">
                          <label>Custom Select Multiple</label>
                          <select multiple class="custom-select">
                            <option>option 1</option>
                            <option>option 2</option>
                            <option>option 3</option>
                            <option>option 4</option>
                            <option>option 5</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Custom Select Multiple Disabled</label>
                          <select multiple class="custom-select" disabled>
                            <option>option 1</option>
                            <option>option 2</option>
                            <option>option 3</option>
                            <option>option 4</option>
                            <option>option 5</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch1">
                        <label class="custom-control-label" for="customSwitch1">Toggle this custom switch
                          element</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="checkbox" class="custom-control-input" id="customSwitch3">
                        <label class="custom-control-label" for="customSwitch3">Toggle this custom switch element with
                          custom colors danger/success</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" disabled id="customSwitch2">
                        <label class="custom-control-label" for="customSwitch2">Disabled custom switch element</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="customRange1">Custom range</label>
                      <input type="range" class="custom-range" id="customRange1">
                    </div>
                    <div class="form-group">
                      <label for="customRange2">Custom range (custom-range-danger)</label>
                      <input type="range" class="custom-range custom-range-danger" id="customRange2">
                    </div>
                    <div class="form-group">
                      <label for="customRange3">Custom range (custom-range-teal)</label>
                      <input type="range" class="custom-range custom-range-teal" id="customRange3">
                    </div>
                    <div class="form-group">
                      <!-- <label for="customFile">Custom File</label> -->

                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                      </div>
                    </div>
                    <div class="form-group">
                    </div>
                  </form>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!--/.col (right) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
            </div>

            <!-- <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
                    <div class="text-center text-sm sm:text-left">
                        &nbsp;
                    </div>

                    <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div> -->
        </div>
    </div>
</body>

</html>
