<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
      html {
        font-family: sans-serif;
        font-size: 15px;
      }
      html, body {
        width: 100%;
        height: 100%;
        overflow: hidden;
        background: #b8b8b8;
        color: #333;
      }
      html, body, h1, p {
        margin: 0;
        padding: 0;
      }
      body {
        position: relative;
      }
      h1 {
        height: 20px;
        line-height: 22px;
        font-size: 16px;
        font-weight: bold;
        padding: 2px 0 0 4px;
      }
      p {
        height: 17px;
        line-height: 17px;
        font-size: 12px;
        padding: 0 0 0 4px;
      }
      strong {
        font-weight: bold;
      }
      a {
        color: black !important;
      }
      .frame {
        position: absolute;
        width: 206px;
        height: 56px;
        left: 50%;
        top: 50%;
        margin: -28px 0 0 -103px;
        overflow: hidden;

        background: #ffffff;
        background: -moz-linear-gradient(top,  #ffffff 22%, #f2f2f2 100%);
        background: -webkit-linear-gradient(top,  #ffffff 22%,#f2f2f2 100%);
        background: linear-gradient(to bottom,  #ffffff 22%,#f2f2f2 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#f2f2f2',GradientType=0 );
      }
      .smaller {
        font-size: 12px;
      }
      .avatar {
        width: 56px;
        height: 56px;
        float: left;
        margin-right: 5px;
      }
    </style>
    <script type="text/javascript">
      if (window==window.top) {
        window.location.replace("{{ route('users.show', ['id' => $user->id]) }}");
      }
    </script>
  </head>
  <body>
    <a href="{{ route('users.show', ['id' => $user->id]) }}" target="user_{{ $user->id }}">
      <div class="frame">
        @if($user->image_url)
            <img class="avatar" src="{{ $user->image_url }}">
        @endif
        <h1>{{ $user->username }}</h1>
        <p>Level: <strong>{{ $user->level() }}</strong></p>
        <p>Points: <strong>{{ $user->points }} / {{ $user->pointsToLevelUp() }}</strong></p>
      </div>
    </a>
  </body>
</html>
