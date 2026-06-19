@php
	$tags = Conner\Tagging\Model\Tag::all();

	
	$tagsArray = [];
	foreach($tags as $tag){
		array_push($tagsArray, $tag->name);
	}
	$tagsArrayString = implode(', ', $tagsArray);

	$existingEbookTags = [];
	foreach($ebook->tags as $tag){
		array_push($existingEbookTags, $tag->name);
	}
	$existingEbookTagsString = implode(', ', $existingEbookTags);

@endphp
<div>
	<p>Separate multiple tags with comma - (eg. BSc,   BTech,   HNG,   NCE)</p>
</div>
<!-- {{ Form::textarea('tags', 'Tags', $errors, $ebook, ['rows' => 4, 'help'=>$tagsArrayString ]) }} -->

<textarea name="tags" class="form-control  ui-autocomplete-input" id="tags" rows="4" cols="10" autocomplete="off">{{ $existingEbookTagsString }}
</textarea>

<div>
	<code>{{ e($tagsArrayString) }}</code>
</div>


<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>


<script>
	jQuery.noConflict();
	console.log('asd');
	(function( $ ) {
		$(function() {
			$("document").ready(function() {
				// The tags we will be looking for
				var categoryTags = ["interest", "research", "personal", "social", "inventory"];
				
				// pass php tags array to js array
				var tags = new Array(
					<?php 
						foreach($tagsArray as $tag){
							echo '"' . $tag .'",';
						}
					 ?>
					);

				// State variable to keep track of which category we are in
				var tagState = tags;

				// Helper functions
				function split(val) {
					return val.split( /,\s*/ );
				}

				function extractLast(term) {
					return split(term).pop();
				}


				$("#tags")

				// Create the autocomplete box
				.autocomplete({
					minLength : 0,
					autoFocus : true,
		            source : function(request, response) {
		                // Use only the last entry from the textarea (exclude previous matches)
		                lastEntry = extractLast(request.term);

						var filteredArray = $.map(tagState, function(item) {
							if (item.indexOf(lastEntry) === 0) {
								return item;
							} else {
								return null;
							}
						});
		               
						// delegate back to autocomplete, but extract the last term
						response($.ui.autocomplete.filter(filteredArray, lastEntry));
					},
					focus : function() {
						// prevent value inserted on focus
						return false;
					},
					select : function(event, ui) {
						var terms = split(this.value);
						// remove the current input
						terms.pop();
						// add the selected item
						terms.push(ui.item.value);
						// add placeholder to get the comma-and-space at the end
						terms.push("");
						this.value = terms.join(", ");
						return false;
					}
				}).on("keydown", function(event) {
					// don't navigate away from the field on tab when selecting an item
					if (event.keyCode === $.ui.keyCode.TAB /** && $(this).data("ui-autocomplete").menu.active **/) {
						event.preventDefault();
						return;
					}

					// Code to position and move the selection box as the user types
					$(this).autocomplete("option", "position", {
						my : "left top",
						at : "left bottom"
					});
				});
			});
		});

	})(jQuery);
</script>

