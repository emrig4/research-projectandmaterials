<?php 
$b64Doc='';

$b64Doc = base64_encode(file_get_contents($url));

?>
<link rel="stylesheet" href="{{ v(Theme::url('public/js/pdfjs-dist/web/pdf_viewer.css')) }}">
<style>
    #viewerContainer {width: 100%;height: 100%;background-color: #404040;overflow-x: auto;} 
    #canvasContainer {width: 100%;height: 100%;} 
    .pdfViewer .page{width: auto !important;height: auto !important; margin: inherit;}
</style>
<div id="canvasContainer">
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

      // Some PDFs need external cmaps.
      //
      var CMAP_URL = "{{ Theme::url('public/js/pdfjs-dist/cmaps') }}";
      var CMAP_PACKED = true;

      var SEARCH_FOR = ""; // try 'Mozilla';

      var eventBus = new pdfjsViewer.EventBus();

      // (Optionally) enable hyperlinks within PDF files.
      var pdfLinkService = new pdfjsViewer.PDFLinkService({
        eventBus: eventBus,
      });

      // (Optionally) enable find controller.
      var pdfFindController = new pdfjsViewer.PDFFindController({
        eventBus: eventBus,
        linkService: pdfLinkService,
      });

      // Loading document.
      @if($b64Doc!='')
          var loadingTask = pdfjsLib.getDocument({
            data: pdfData,
            cMapUrl: CMAP_URL,
            cMapPacked: CMAP_PACKED,
          });
      @else
          var loadingTask = pdfjsLib.getDocument({
            url: DEFAULT_URL,
            cMapUrl: CMAP_URL,
            cMapPacked: CMAP_PACKED,
          });
      @endif


      var currPage = 1; //Pages are 1-based not 0-based
      var numPages = 0;
      var thePDF = null;

      //This is where you start
      loadingTask.promise.then(function(pdf) {

              //Set PDFJS global object (so we can easily access in our page functions
              thePDF = pdf;

              //How many pages it has
              numPages = pdf.numPages;

              //Start with first page
              pdf.getPage( 1 ).then( handlePages );
      });



      function handlePages(page)
      {
          
          //We'll create a canvas for each page to draw it on
          var canvasContainer = document.getElementById('canvasContainer');

          var viewport = page.getViewport({scale: 0.9});
          var scale = canvasContainer.clientWidth / viewport.width;
          viewport = page.getViewport({scale: scale});

          
          var canvas = document.createElement( "canvas" );
          // canvas.style.display = "block";
          var context = canvas.getContext('2d');
          canvas.height = viewport.height;
          canvas.width = viewport.width;

          //Draw it on the canvas
          page.render({canvasContext: context, viewport: viewport});

          //Add it to the web page
          canvasContainer.appendChild( canvas );

          //Move to next page
          currPage++;
          window.onscroll = function() {
            
            // space from bottom of page to canvasContainer element
            var distanceFromBottomToContainer = window.innerHeight - canvasContainer.offsetTop + canvasContainer.offsetHeight
            // console.log('space ' + distanceFromBottomToContainer)

            // distance top of window window
            let distanceFromTop = Math.max(window.pageYOffset, document.documentElement.scrollTop, document.body.scrollTop) //+ window.innerHeight //>= (document.documentElement.offsetHeight - canvas.height - 600);

            // console.log('distanceFromTop ' + distanceFromTop)

            if(distanceFromTop >= distanceFromBottomToContainer ){
              if ( thePDF !== null && currPage <= numPages ){
                  thePDF.getPage( currPage ).then( handlePages );
              }
            }
          };

          // if ( thePDF !== null && currPage <= numPages )
          // {
          //     thePDF.getPage( currPage ).then( handlePages );
          // }
      }

    </script>
@push('scripts')
    <script>
        (function () {
            "use strict";
            
            $(document).ready(function() {
                $("#pdfviewer-xloder").remove();
                
            });

        })(); 
    </script>
@endpush