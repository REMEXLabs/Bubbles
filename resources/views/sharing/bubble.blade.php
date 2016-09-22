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
        height: 18px;
        line-height: 18px;
        font-size: 13px;
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
        width: 208px;
        height: 58px;
        left: 50%;
        top: 50%;
        margin: -29px 0 0 -104px;
        background: #ddd;
        overflow: hidden;
      }
      .smaller {
        font-size: 12px;
      }
      .avatar {
        width: 58px;
        height: 58px;
        float: left;
        margin-right: 5px;
      }
    </style>
    <script type="text/javascript">
      if (window==window.top) {
        window.location.replace("{{ route('bubbles.show', ['id' => $bubble->id]) }}");
      }
    </script>
  </head>
  <body>
    @if($bubble->type == 'project')
    <a href="{{ route('projects.show', ['id' => $bubble->project()->id]) }}" target="bubbles_{{ $bubble->id }}">
    @endif
    @if($bubble->type == 'quest')
    <a href="{{ route('quests.show', ['id' => $bubble->quest()->id]) }}" target="bubbles_{{ $bubble->id }}">
    @endif
      <div class="frame">
        @if($bubble->type == 'project')
            <h1>{{ $bubble->project()->name }}</h1>
            <p>Type: <strong>Project</strong></p>
        @endif
        @if($bubble->type == 'quest')
            <h1>{{ $bubble->quest()->name }}</h1>
            <p>Type: <strong>Quest</strong></p>
            <p>Status: <strong>{{ Quest::getStates()[$bubble->quest()->state] }}</strong></p>
        @endif
      </div>
    </a>
  </body>
</html>
