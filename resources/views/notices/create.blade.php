<x-app-dashboard name="Notices" icon="file-plus">

    <x-links>
        <script src="{{ asset('js/ckeditor.min.js') }}"></script>
    </x-links>

    <x-form action="">

        <input type="hidden"name="session_id" value="{{ $current_school_session_id }}">

        <x-form-textarea name="notice" label="Write Note" id="editor" rows="10" placeholder="Write here..." ></x-form-textarea>

        <button type="submit"
                class="btn btn-outline-primary my-3">
                <i class="fas fa-check"></i> Save
        </button>
    </x-form>

    <script>
        function DisallowNestingTables( editor ) {
            editor.model.schema.addChildCheck( ( context, childDefinition ) => {
                if ( childDefinition.name == 'table' && Array.from( context.getNames() ).includes( 'table' ) ) {
                    return false;
                }
            } );
        }
        ClassicEditor.create( document.querySelector( '#editor' ), {
            extraPlugins: [ DisallowNestingTables ],
            table: {
                toolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
            }
        }).catch( error => {
            console.error( error );
        } );
    </script>
</x-app-dashboard>
