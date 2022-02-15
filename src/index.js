const { registerBlockType } = wp.blocks;
// To add form block
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

// To add list
registerBlockType( 'namespace/guestpost', {
    // Built in attributes
    title: 'Guest Post List',
    description: 'Block to show Guest Posts',
    icon: 'editor-ul',
    category: 'widgets',

    // Custom attributes
    attributes: {},



    // Custom functions


    // Built in functions
    edit() {
        return <div>[guest_posts]</div>;
    },

    save() {
        return <div>[guest_posts]</div>;
    }

});