<p>CPU benchmarks so-frequently include a ray-tracer that some ray-tracing software includes <a href="http://www.povray.org/download/benchmark.php" title="Benchmarking with POV-Ray">a standard scene for benchmarking</a>.</p>

<p>We'll use this simple, recursive, greyscale, scene (N=200)</p>
<img src="<?=IMAGE_PATH;?>raytracer200.png" alt="Ray-tracer output N=200,converted to PNG" height="200" width="200" />


<p><br />Correct output N=32 is in this 1KB <a href="iofile.php?test=<?=$SelectedTest;?>&amp;lang=<?=$SelectedLang;?>&amp;sort=<?=$Sort;?>&amp;file=output&amp;ext=pgm">output file</a>.</p>
<p>Thanks to Jon Harrop for this benchmark.</p>
