@extends('layouts.app')

@section('application-module-name')

  <p class="text-light mb-0 font-weight-light">
    Koszt palenia
  </p>

@endsection

@section('content')

  <div class="h3 mb-3 text-info ml-4">Ustawienia</div>
  <div class="h5 mb-3 text-primary ml-4 ">Ceny  i parametry palenia</div>

  <div class="row justify-content-start mx-4"> 

    <div class="col-md-6 col-lg-4 col-xl-3 mb-3">
      <div class="h6 text-white">Ceny blachy:</div>
      <table class="table table-hover table-sm table-dark">
        <thead>
          <tr>
            <th scope="col" class="text-center">Blacha<br>[mm]</th>
            <th scope="col" class="text-center">S235JR<br>[zł/kg]</th>
            <th scope="col" class="text-center">DX-51D<br>[zł/kg]</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row" class="text-center">1</th>
            <td class="text-warning text-center font-weight-bold">1,70</td>
            <td class="text-warning text-center font-weight-bold">1,70</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">2</th>
            <td class="text-warning text-center font-weight-bold">1,70</td>
            <td class="text-warning text-center font-weight-bold">2,20</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">3</th>
            <td class="text-warning text-center font-weight-bold">1,70</td>
            <td class="text-warning text-center font-weight-bold">2,70</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">4</th>
            <td class="text-warning text-center font-weight-bold">1,70</td>
            <td class="text-warning text-center font-weight-bold">--</td>
          </tr>
        </tbody>
      </table>
    </div>


    <div class="col-md-6 col-lg-4 col-xl-3 mb-3">
      <div class="h6 text-white">Dysza: 40A</div>
      <table class="table table-hover table-sm table-dark">
        <thead>
          <tr>
            <th scope="col" class="text-center">Blacha<br>[mm]</th>
            <th scope="col" class="text-center">Prędkość palenia<br>[mm/s]</th>
            <th scope="col" class="text-center">Koszt<br>[zł/mb]</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row" class="text-center">1</th>
            <td class="text-center">3000</td>
            <td class="text-warning text-center font-weight-bold">1,70</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">2</th>
            <td class="text-center">2200</td>
            <td class="text-warning text-center font-weight-bold">2,20</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">3</th>
            <td class="text-center">1800</td>
            <td class="text-warning text-center font-weight-bold">2,70</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="col-md-6 col-lg-4 col-xl-3 mb-3">
      <div class="h6 text-white">Dysza: 60A</div>
      <table class="table table-hover table-sm table-dark">
        <thead>
          <tr>
            <th scope="col" class="text-center">Blacha<br>[mm]</th>
            <th scope="col" class="text-center">Prędkość palenia<br>[mm/s]</th>
            <th scope="col" class="text-center">Koszt<br>[zł/mb]</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row" class="text-center">1</th>
            <td class="text-center">3000</td>
            <td class="text-warning text-center font-weight-bold">1,70</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">2</th>
            <td class="text-center">2200</td>
            <td class="text-warning text-center font-weight-bold">2,20</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">3</th>
            <td class="text-center">1800</td>
            <td class="text-warning text-center font-weight-bold">2,70</td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>

@endsection