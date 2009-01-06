<p><strong>NOT ACCEPTED:</strong> 'let' is a fully lazy binding. A thunk for the tree is allocated which lives on until the force node of the tree is demanded, at which point the whole tree is forced (since its a strict tree).<br/><br/>

To force evaluation of the tree prior to its use, just change the let :<br/><br/>

    let !long = ...<br/><br/>

is fine.</p>
