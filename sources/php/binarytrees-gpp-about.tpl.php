<p><strong>NOT ACCEPTED:</strong> Technically it _does_ allocate the tree nodes one at a time, using placement new.  It just allocates them within a block of memory which is allocated in one go.</p>
