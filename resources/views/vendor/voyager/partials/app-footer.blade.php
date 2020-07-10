<footer class="app-footer">
    <div class="site-footer-right">
        @if (rand(1,100) == 100)
        <i class="voyager-rum-1"></i> {{ __('voyager::theme.footer_copyright2') }}
        @else
        {!! __('voyager::theme.footer_copyright') !!} <a href="http://shumoninventory.herokuapp.com"
            target="_blank">Shumon
            Pal</a>
        @endif
        v 1.0.0
    </div>
</footer>