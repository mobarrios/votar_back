<footer class="main-footer">
    <div class="pull-right hidden-xs">

        Branch: <b>{{shell_exec('git branch | grep \*')}}</b> |
        Version: <b>{{shell_exec('git describe --tags')}}</b>
    </div>
    <strong>NavCoder</strong> All rights
    reserved.
</footer>
