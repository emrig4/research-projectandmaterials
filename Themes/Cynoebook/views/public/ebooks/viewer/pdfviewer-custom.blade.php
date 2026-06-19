<?php 
$b64Doc='';
$b64Doc = base64_encode(file_get_contents($url));
?>
<link rel="stylesheet" href="{{ v(Theme::url('public/js/pdfjs-dist/web/pdf_viewer.css')) }}">
<style>
    #viewerContainer {width: 100%;height: 500px;background-color: #404040;overflow-x: auto;} 
    .pdfViewer .page{width: auto !important;height: auto !important;}
</style>

<div class="row">
  <div class="col-md-12" style="padding-right: 15px;">
    <input type="button" id="prevBtn" />
     <input type="button" id="nextBtn" />
  </div>
  <div class="col-md-12" id="the-container">
    <canvas id="the-canvas"></canvas>
  </div>
</div>

<div id="pdfviewer-xloder">
    <script>
        var DEFAULT_URL= "{{ $url }}";
        @if($b64Doc!='')
            var pdfData = atob('{{ $b64Doc  }}');
        @endif;
    </script>
</div>
    
    <script src="{{ v(Theme::url('public/js/pdfjs-dist/build/pdf.min.js')) }}"></script>
    <script src="{{ v(Theme::url('public/js/pdfjs-dist/web/pdf_viewer.js')) }}"></script>
    
    <script>
        
        if (!pdfjsLib.getDocument || !pdfjsViewer.PDFViewer) {
          alert("Please build the pdfjs-dist library using\n  `gulp dist-install`");
        }

        // The workerSrc property shall be specified.
        //
        pdfjsLib.GlobalWorkerOptions.workerSrc =
          "{{ Theme::url('public/js/pdfjs-dist/build/pdf.worker.js') }}";

        // Loading document.
        @if($b64Doc!='')
            var loadingTask = pdfjsLib.getDocument({
              data: pdfData,
            });
        @else
            var loadingTask = pdfjsLib.getDocument({
              url: DEFAULT_URL,
            });
        @endif


        var currentPageIndex = 0;
        var pdfInstance = null;
        var totalPagesCount = 0;

        
        // init
        loadingTask.promise.then(function(pdf) {
          pdfInstance = pdf;
          totalPagesCount = pdf.numPages;
          render();
        });


        // render
        // var viewport = document.querySelector('#viewport')
        function render() {
          pdfInstance.getPage(currentPageIndex + 1)
            .then(function(page) {
              renderPage(page)
            })
        }


        // rendering method
        function renderPage(page) {

          var container = document.getElementById('the-container');
          var canvas = document.getElementById('the-canvas');
          var context = canvas.getContext('2d');

          var viewport = page.getViewport({scale: 1});
          var scale = container.clientWidth / viewport.width;
          viewport = page.getViewport({scale: scale});

          canvas.height = viewport.height;
          canvas.width = viewport.width;


          page.render({
            canvasContext: context,
            viewport: viewport
          });
        }

    </script>
@push('scripts')
    <script>
        (function () {
            "use strict";
            
            $(document).ready(function() {
                $("#pdfviewer-xloder").remove();
                
            });

            $('#nextBtn').click(function onNextPage() {
              
              currentPageIndex++;
              if (currentPageIndex > totalPagesCount - 1) {
                currentPageIndex = totalPagesCount - 1;
              }
              render();
            })

            $('#prevBtn').click(function onPrevPage() {
              currentPageIndex--;
              if (currentPageIndex < 0) {
                currentPageIndex = 0;
              }
              render();
            })

        })(); 
    </script>
@endpush