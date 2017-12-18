@extends('layouts.app')

@section('content')
<body class="bgimg">

  <table style="width:100%">
      <tr>
          <th>  <div class=" text-center">
                  <div class="jumbotron container">
                      <br>
                      <br>
                      <br>
                      <h1 style="color: #824b8e">PickBook</h1>
                      <h4 style=" color: #87766C;">Dear Reader, You're Among Friends...</h4>
                  </div>
              </div>
          </th>
          <th>

          </th>
      </tr>
  </table>
</body>

<style>
    body{
    background-color: #ffe6ff;
}
    .jumbotron {
    background-color: transparent;


}

    .bgimg {
        background-image: url('/assets/images/welcomee.jpg');
    }

</style>

@endsection
