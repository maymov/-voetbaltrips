{!! Form::open(array('action'=>'PurchaseController@store','method'=>'POST')) !!}

<select name="paymentmethod">
    @foreach($pay as $payment)
        <option value="{{$payment->getId() }}">{{$payment->getName()}}</option>
    @endforeach
</select>

<select name="issuer">
    @foreach($issuers as $issuer)
        <option value="{{ $issuer->getId() }}" name="issuer">{{$issuer->getName()}}</option>
    @endforeach
    <option value="1">of wat anders</option>
</select>

{!! Form::submit() !!}
{!! Form::close() !!}