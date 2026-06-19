<?php 
$b64Doc='';
if ($type=='upload'){
    $b64Doc = base64_encode(file_get_contents($url));
}
?>
<link rel="stylesheet" href="{{ v(Theme::url('public/js/pdfjs-dist/web/pdf_viewer.css')) }}">
<style>
    #viewerContainer {width: 100%;height: 100%;} 
   /* .pdfViewer .page{width: auto !important;height: auto !important;}*/

    .pdfViewer .page{
        border-image: none !important;
        /*box-shadow: -12px 4px 5px 4px grey;*/
        margin: inherit;
        border: thin solid #ddd;
        margin-bottom: 10px;
        width: 100% !important;
    }
    .canvasWrapper {
      width: 100% !important;
    }
    .canvasWrapper svg {
      width: 105% !important;
    }
    .panel-body {
      padding: 1px;

    }
</style>
<div id="viewerContainer">
        <div id="viewer" class="pdfViewer"></div>
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
        //var CMAP_URL = "{{ Theme::url('public/js/pdfjs-dist/cmaps') }}";
        //var CMAP_PACKED = true;

        var SEARCH_FOR = ""; // try 'Mozilla';

        var container = document.getElementById("viewerContainer");

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

        var pdfViewer = new pdfjsViewer.PDFViewer({
          container: container,
          eventBus: eventBus,
          linkService: pdfLinkService,
          findController: pdfFindController,

          renderer: "svg",
          textLayerMode: 0,
        });
        pdfLinkService.setViewer(pdfViewer);

        eventBus.on("pagesinit", function () {
          // We can use pdfViewer now, e.g. let's change default scale.

          // auto, page-fit, page-height, page-width, page-actual
          pdfViewer.currentScaleValue = "page-fit";

          // We can try searching for things.
          if (SEARCH_FOR) {
            pdfFindController.executeCommand("find", { query: SEARCH_FOR });
          }
        });

        // Loading document.
        @if($b64Doc!='')
            var loadingTask = pdfjsLib.getDocument({
              data: pdfData,
              //cMapUrl: CMAP_URL,
              //cMapPacked: CMAP_PACKED,
            });
        @else
            var loadingTask = pdfjsLib.getDocument({
              url: DEFAULT_URL,
              //cMapUrl: CMAP_URL,
              //cMapPacked: CMAP_PACKED,
            });
        @endif
        
        
        loadingTask.promise.then(function (pdfDocument) {
            
          // Document loaded, specifying document for the viewer and
          // the (optional) linkService.
          pdfViewer.setDocument(pdfDocument);

          pdfLinkService.setDocument(pdfDocument, null);
          //var numPages = pdfDocument.numPages;
           
        });


        // airon
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