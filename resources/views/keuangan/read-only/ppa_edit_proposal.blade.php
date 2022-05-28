@extends('keuangan.parent.ppa_edit_proposal')

@section('row')
  @php
  $i = 1;
  @endphp
  @foreach($ppaDetail->proposals as $p)
  <tr id="p-{{ $p->id }}">
      <td class="font-weight-bold">{{ $i }}</td>
      <td class="font-weight-bold" colspan="5">{{ $p->title }}</td>
  </tr>
  @php
  $j = 1;
  @endphp
  @foreach($p->details as $d)
  <tr id="d-{{ $d->id }}">
      <td>{{ $i.'.'.($j++) }}</td>
      <td>{{ $d->desc }}</td>
      <td>{{ $d->priceWithSeparator }}</td>
      <td>{{ $d->quantityWithSeparator }}</td>
      <td>{{ $d->valueWithSeparator }}</td>
      @if(($apbyAktif && $apbyAktif->is_active == 1) && $isAnggotaPa && ((in_array(Auth::user()->role->name, ['fam','faspv']) && $ppaAktif->finance_acc_status_id != 1) || $ppaAktif->pa_acc_status_id != 1))
      <td>&nbsp;</td>
      @endif
  </tr>
  @endforeach
  @php
  $i++;
  @endphp
  @endforeach

@endsection
