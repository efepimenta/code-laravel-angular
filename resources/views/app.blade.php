<!DOCTYPE html>
<html lang="pt-br" ng-app="app">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Language" content="pt-br">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @if( Config::get('app.debug') )
        <link href="{{ asset('build/css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('build/css/components.css') }}" rel="stylesheet">
        <link href="{{ asset('build/css/flaticon.css') }}" rel="stylesheet">
        <link href="{{ asset('build/css/font-awesome.css') }}" rel="stylesheet">
    @else
        <link href="{{ elixir('css/all.css') }}" rel="stylesheet">
@endif
<!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#/home">Home</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Clients <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a ng-href="#/clients">Client List</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#/clients/new">New Client</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Project <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a ng-href="#/projects">Project List</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#/project/new">New Project</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Project Notes <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a ng-href="#/project/1/notes">Note List</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#/project/1/notes/new">New Note</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Project Tasks <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a ng-href="#/project/1/tasks">Task List</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#/project/1/task/new">New Task</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Project Members <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a ng-href="#/project/1/members">Member List</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#/project/1/member/new">New Member</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Project Files <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a ng-href="#/project/1/files">File List</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#/project/1/file/new">New File</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if(auth()->guest())
                    @if(!Request::is('auth/login'))
                        <li><a href="{{ url('#/login') }}">Login</a></li>
                    @endif
                    @if(!Request::is('auth/register'))
                        <li><a href="{{ url('/auth/register') }}">Register</a></li>
                    @endif
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">{{ auth()->user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<div ng-view></div>

@if( Config::get('app.debug') )
    <script src="{{ asset('build/js/vendor/jquery.js') }}"></script>
    <script src="{{ asset('build/js/vendor/bootstrap.js') }}"></script>
    <script src="{{ asset('build/js/vendor/angular.js') }}"></script>
    <script src="{{ asset('build/js/vendor/angular-route.js') }}"></script>
    <script src="{{ asset('build/js/vendor/angular-resource.js') }}"></script>
    <script src="{{ asset('build/js/vendor/angular-animate.js') }}"></script>
    <script src="{{ asset('build/js/vendor/angular-messages.js') }}"></script>
    <script src="{{ asset('build/js/vendor/ui-bootstrap-tpls.js') }}"></script>
    <script src="{{ asset('build/js/vendor/navbar.js') }}"></script>
    <script src="{{ asset('build/js/vendor/angular-cookies.js') }}"></script>
    <script src="{{ asset('build/js/vendor/query-string.js') }}"></script>
    <script src="{{ asset('build/js/vendor/angular-oauth2.js') }}"></script>
    <script src="{{ asset('build/js/vendor/ng-file-upload-all.js') }}"></script>

    <script src="{{ asset('build/js/app.js') }}"></script>
    {{--CONFIGS--}}
    <script src="build/js/config/login.js"></script>
    <script src="build/js/config/clients.js"></script>
    <script src="build/js/config/projects.notes.js"></script>
    <script src="build/js/config/projects.tasks.js"></script>
    <script src="build/js/config/projects.members.js"></script>
    <script src="build/js/config/projects.files.js"></script>
    <script src="build/js/config/projects.js"></script>
    {{--CONTROLLERS--}}
    <script src="{{ asset('build/js/controllers/home.js') }}"></script>
    <script src="{{ asset('build/js/controllers/login.js') }}"></script>
    {{--clients--}}
    <script src="{{ asset('build/js/controllers/client/clientList.js') }}"></script>
    <script src="{{ asset('build/js/controllers/client/clientNew.js') }}"></script>
    <script src="{{ asset('build/js/controllers/client/clientEdit.js') }}"></script>
    <script src="{{ asset('build/js/controllers/client/clientRemove.js') }}"></script>
    {{--projects--}}
    <script src="{{ asset('build/js/controllers/project/projectList.js') }}"></script>
    <script src="{{ asset('build/js/controllers/project/projectNew.js') }}"></script>
    <script src="{{ asset('build/js/controllers/project/projectEdit.js') }}"></script>
    <script src="{{ asset('build/js/controllers/project/projectRemove.js') }}"></script>
    {{--project notes--}}
    <script src="{{ asset('build/js/controllers/project/note/noteList.js') }}"></script>
    <script src="{{ asset('build/js/controllers/project/note/noteNew.js') }}"></script>
    <script src="{{ asset('build/js/controllers/project/note/noteEdit.js') }}"></script>
    <script src="{{ asset('build/js/controllers/project/note/noteRemove.js') }}"></script>
    {{--project tasks--}}
    <script src="{{ asset('build/js/controllers/project/task/taskList.js') }}"></script>
    <script src="{{ asset('build/js/controllers/project/task/taskNew.js') }}"></script>
    <script src="{{ asset('build/js/controllers/project/task/taskEdit.js') }}"></script>
    <script src="{{ asset('build/js/controllers/project/task/taskRemove.js') }}"></script>
    {{--project members--}}
    <script src="{{ asset('build/js/controllers/project/member/memberList.js') }}"></script>
    <script src="{{ asset('build/js/controllers/project/member/memberNew.js') }}"></script>
    <script src="{{ asset('build/js/controllers/project/member/memberEdit.js') }}"></script>
    <script src="{{ asset('build/js/controllers/project/member/memberRemove.js') }}"></script>
    {{--project files--}}
    <script src="{{ asset('build/js/controllers/project/file/fileList.js') }}"></script>
    <script src="{{ asset('build/js/controllers/project/file/fileNew.js') }}"></script>
    <script src="{{ asset('build/js/controllers/project/file/fileEdit.js') }}"></script>
    <script src="{{ asset('build/js/controllers/project/file/fileRemove.js') }}"></script>
    {{--SERVICES--}}
    <script src="{{ asset('build/js/services/url.js') }}"></script>
    <script src="{{ asset('build/js/services/client.js') }}"></script>
    <script src="{{ asset('build/js/services/user.js') }}"></script>
    <script src="{{ asset('build/js/services/project.note.js') }}"></script>
    <script src="{{ asset('build/js/services/project.task.js') }}"></script>
    <script src="{{ asset('build/js/services/project.member.js') }}"></script>
    <script src="{{ asset('build/js/services/project.file.js') }}"></script>
    <script src="{{ asset('build/js/services/project.js') }}"></script>
    {{--FILTER--}}
    <script src="{{ asset('build/js/filters/dateBr.js') }}"></script>
    {{--DIRECTIVES--}}
    <script src="{{ asset('build/js/directives/fileDownload.js') }}"></script>
@else
    <script src="{{ elixir('js/all.js') }}"></script>
@endif
</body>
</html>