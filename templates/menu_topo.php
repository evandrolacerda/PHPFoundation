<ul class="nav nav-tabs">
    <li role="presentation"><a href="/home">Home</a></li>
    <li role="presentation"><a href="/empresa">Empresa</a></li>
    <li role="presentation"><a href="/produtos">Produtos</a></li>
    <li role="presentation"><a href="/servicos">Servi&ccedil;os</a></li>
    <li role="presentation"><a href="/contato">Contato</a></li>    
    <li>
        <form class="navbar-form navbar-left" action="/busca" role="search">
            <div class="form-group">
                <input type="text" name="busca" class="form-control" placeholder="Buscar">
            </div>
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </form>   
    </li>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo url('/admin');?>"> <span class="glyphicon glyphicon-user"></span> &nbsp;Área Administrativa</a></li>        
    </ul>

</ul>



