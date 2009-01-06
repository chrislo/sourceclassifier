<?php $base=".";
      $title="About the Languages";
      $keywords = "performance, benchmark, computer, algorithms, languages, compare, cpu, memory";
      require("html/header.php");
      require("html/toptabs.php");
      $parts = Explode('/', $_SERVER["SCRIPT_NAME"]);
      $current = $parts[count($parts) - 1];

      toptabs($current) ?>

<div id="bodycol">
<table border="0" cellspacing="0" cellpadding="4" id="main" width="100%">
  <tr valign="top">
    <td width="60%">
      <?php require("versions.html"); ?>
    </td>
    <td>
      <div class="app">
        <div class="h3" id="langs">
          <h3>About the Languages</h3>
          <p>The languages compared here are a mixture of compiled and
	      interpreted, functional and imperative.  Compiled languages have
	      the natural advantage of running machine code that can be
	      optimized by the compiler.  The interpreted languages are often
	      byte-compiled, and sometimes optimized.  Many of the tests were
	      originally designed to test imperative features, and do not fairly
	      test some languages (like Haskell).  If you want to compare
	      languages of the same <em>type</em>, consider:
          <ul>
	      <li>The languages that are in <b><i>bold italics</i></b> compile
	        to machine code.  The others are either byte-compiled or just
		interpreted.
		<p>When using C and C++, I think it is normal and expected to
		  use external libraries.  In this vein, we'll often use
		  <a href="http://www.sgi.com/tech/stl/">STL</a>
		  <a href="http://www.sgi.com/tech/stl/download.html">v3.3</a>
		  with C++.</p>
		<p>However, with most other languages we will try to use only
		  features in the language's core or its standard libraries.</p>
		<p>There is also a very handy library for doing Perl Compatible
		  Regular Expressions: PCRE (see the <a href="bench/regexmatch">
		  Regular Expression Matching</a> test), which I will use with
		  some languages.</p></li>
	      <li>Bigloo Scheme, Clean, CMU Common Lisp, Gwydion Dylan,
	        SmallEiffel, GHC (Haskell), Ocaml, MLton, and SML/NJ compile to
		native code.  Some are actually compiled to intermediate C
		first.</li><br>
              <li>Sun's Java uses a JIT compiler so the code is compiled to
	        native code on the fly.</li><br>
              <li>Guile, Lua, MzScheme, Oz, Perl, PHP, Python, Rep, Ruby and
	        Tcl are all interpreted <i>scripting</i> / <i>extension</i>
		languages, and they can probably all be considered competitors
		in the same space.  Perl, Python, Ruby and Tcl all come with
		extensive libraries in their standard distributions.  Guile and
		Rep have less extensive libraries, and Lua is absolutely tiny,
		with no extra libraries.</li><br>
              <li>Pike and Icon are not strictly extension languages but are
	        similar in many ways to the previous group.</li><br>
              <li>Erlang also compiles to bytecodes, but it isn't really
	        thought of as a scripting language.</li><br>
              <li>AWK is really just a scripting language, it's not typically
	        embedded or extended with C or other compiled languages.</li><br>
              <li>Gforth is an interpreted forth, and it can produce extremely
	        fast code.  But Forth is a pretty low-level language, and
		optimization usually left up to the programmer.</li><br>
              <li>Bash is included just for fun.  Its test often resort to the
	        standard bash programming technique of calling the usual Unix
		shell commands.</li><br>
            </ul>
	  </div>
	</div>
      </div>
    </td>
  </tr>
</table>

<?php require("html/footer.php") ?>
<!-- nobody really reads the mail sent to these addresses ... can ya dig it? -->
<a href="mailto:charlescosgroveclean007@net-sieve.com">&nbsp;</a>
<a href="mailto:jack.bo.sh@infospeed.net">&nbsp;</a>
