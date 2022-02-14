const { registerBlockType } = wp.blocks;

registerBlockType( 'namespace/guestpost-form', {
    // Built in attributes
    title: 'Guest Post Form',
    description: 'Block to show Guest Post form',
    icon: 'edit-page',
    category: 'widgets',

    // Custom attributes
    attributes: {},



    // Custom functions


    // Built in functions
    edit() {
        return <div>[guest_post_submit]</div>;
    },

    save() {
        return <div>[guest_post_submit]</div>;
    }

});