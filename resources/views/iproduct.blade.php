<!DOCTYPE html>
<html lang="en">
    <head>
        <title>POS Mini</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

        <!-- <style>
            .jumbotron {
                height: 10px;
                align-items: center;
            }
        </style> -->
    </head>
    <body>

        <div class="jumbotron text-left" style="background-color: #1a1a1a !important;color: white;">
            <h2>Majo Teknologi Indonesia</h2>
        </div>
        
        <div class="container">
            <div class="row text-left">
                <h1>Produk</h1>
            </div>
            <div class="row">
            <?php foreach ($product as $k => $v) { ?>
                <div class="col-sm-3" style="padding: 2px 2px 2px 2px;">
                    <div class="card">
                        <img class="card-img-top" src="{{ URL::to('/') }}/uploads/{{ $v->product_image_name }}" alt="Card image" style="width: auto; height: auto;">
                        <div class="card-body">
                            <div>
                                <h4 class="card-title text-center" style="font-size: 12px;font-weight: bold;">{{ $v->product_identifier }}</h4>
                            </div>
                            <div>
                                <p class="card-text text-center" id="tprice{{ $k }}">Rp. {{ $v->product_price }}</p>
                                <p class="card-text text-left" id="tdesc{{ $k }}" style="font-size: 10px;">{{ $v->product_desc }}</p>
                                <input type="hidden" id="price{{ $k }}" value="{{ $v->product_price }}">
                            </div>
                            <div style="text-align: center;">
                                <a id="processBtn" name="processBtn" onclick="#" class="btn btn-primary">Beli</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>

            <footer class="page-footer text-center">
                <div class="footer-copyright py-3">
                    © <?php echo date('Y'); ?> @ PT Majo Teknologi Indonesia
                </div>
            </footer>
        </div>

    </body>
</html>
<script>
    $(document).ready(function(){

    });


</script>
