{{--<x-app-layout>--}}
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Dashboard') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">--}}
{{--                <div class="p-6 text-gray-900">--}}
{{--                    {{ __("You're logged in!") }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</x-app-layout>--}}


@extends('layouts.home')

@section('contents')

    <div class="row gap-4">

        <div class="col-lg-2 ">

            <div class="card w-100">

                <div class="card-body">
                    <h5 class="fw-light card-title">
                       Total Notes
                    </h5>
                    <p class="card-text" id="nCount"></p>
                </div>

            </div>

        </div>


    </div>

    <script>

        (async ()=>
        {
            await noteCount();
        })()


        async function noteCount()
        {
            let res=  await axios.get('/notes-count');
            $('#nCount').text(res.data.data);
        }

    </script>

@endsection




