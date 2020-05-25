import React, { useState } from 'react';
import { render } from 'react-dom';
import { style } from 'typestyle';
import { Editor } from 'graphql-editor';
export const Full = style({
    backgroundColor: '#444444',
    position: 'relative',
    width: '100%',
    height: '100%',
    paddingLeft: 0,
    transition: 'padding-left 0.12s linear',
});

export const UiDiagram = style({
    flex: 1,
    width: '100%',
    height: '100%',
    alignSelf: 'stretch',
    display: 'flex',
    position: 'relative',
});
export const UIDiagramFull = style({
    marginLeft: '-100vh',
});

// @ts-ignore
const schemaInput = document.getElementById(graphqlEditorValueId) as HTMLInputElement;

export const App = () => {
    const [mySchema] = useState({
        code: schemaInput.value,
        libraries: '',
    });
    return (
        <div className={UiDiagram}>
            <Editor schema={mySchema} graphController={controller => {
                console.log(controller);
            }}/>
        </div>
    );
};

render(<App />, document.getElementById('graphqleditor'));
