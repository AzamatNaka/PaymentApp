@extends('layouts.app')

@section('title', "INDEX PAGE")

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    @if ($errors->any())
                        <div class="alert alert-danger mt-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('status'))
                        <div class="alert alert-success mt-4">
                            {{session('status')}}
                        </div>
                    @endif

                    <div class="card-header">Бизнес</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Баланс счета: {{ $business->balance }} тенге</h4>
                            </div>
                            <div class="col-md-6">
{{--                                <form method="POST" action="#">--}}
{{--                                    @csrf--}}
{{--                                    <button type="submit" class="btn btn-primary float-right">Пополнить счет</button>--}}
{{--                                </form>--}}
                                <button class="btn btn-primary float-right" id="make-payment">Пополнить счет</button>
                            </div>
                        </div>

                        <br>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ФИО</th>
                                <th>Номер телефона</th>
                                <th>Баланс</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->phone }}</td>
                                    <td>{{ $client->balance }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://proxyd.tarlanpayments.kz/tarlan/widget/v7/7.1.0/widget.js"></script>
    <script>
        // Данные тестовые, но позволяют получить ссылку на платежную форму

        function generateForm() {
            var genIframe = window.TarlanPayments.genIframe;

            genIframe(
                {
                    reference_id: Date.now(), // номер заказа
                    request_url: '{{ route('business.index') }}', // адрес для перенаправления после платежа
                    back_url: '{{ route('business.callback') }}', // адрес для отправки коллбека
                    description: 'оплата заказа', // описание платежа
                    amount: 100, // сумма заказа
                    merchant_id: 1, // номер мерчанта
                    is_test: 1, // опция для тестовой оплаты (1 - тестовая оплата, 0 - боевая оплата)
                    secret_key: '123456', // ключ выданный для мерчанта
                    hashSecretKey: true
                },
                {
                    failureCb: function (err) {
                        console.log(err);
                    },
                    onClose: function () {
                        console.log('on close');
                    }
                }
            );
        }

        document.getElementById('make-payment').addEventListener('click', generateForm);
    </script>

@endsection
