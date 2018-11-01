<table>
 <tbody>
  <tr>
   <td>Skpd</td>
   <td>Kode Skpd</td>
  </tr>
  @foreach($Skpd as $skpd)
  <tr>
   <td>{{$skpd['skpd']}}</td>
   <td>{{$skpd['kode_skpd']}}</td>
  </tr>
  @endforeach
 </tbody>
</table>