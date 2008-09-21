# The Computer Language Benchmarks Game
# http://shootout.alioth.debian.org/
#
# contributed by Steve Fisher

dirty_seq = $stdin.readlines.join
seq = dirty_seq.gsub( /(?:^>.*)?\n/, "" )

def count( rx, str )
  total = 0
  rx.split( '|' ).each{|s|
    x = s.sub(/\[.*\]/, " ").size
    total += (str.size - str.gsub(/#{s}/i, "").size)/x }
  total
end

puts [
  'agggtaaa|tttaccct',
  '[cgt]gggtaaa|tttaccc[acg]',
  'a[act]ggtaaa|tttacc[agt]t',
  'ag[act]gtaaa|tttac[agt]ct',
  'agg[act]taaa|ttta[agt]cct',
  'aggg[acg]aaa|ttt[cgt]ccct',
  'agggt[cgt]aa|tt[acg]accct',
  'agggta[cgt]a|t[acg]taccct',
  'agggtaa[cgt]|[acg]ttaccct'
].map{|s| "#{ s } #{ count( s, seq ) }" }

puts
puts dirty_seq.size, seq.size

puts(
{
'B' => '(c|g|t)', 'D' => '(a|g|t)', 'H' => '(a|c|t)', 'K' => '(g|t)',
'M' => '(a|c)', 'N' => '(a|c|g|t)', 'R' => '(a|g)', 'S' => '(c|t)',
'V' => '(a|c|g)', 'W' => '(a|t)', 'Y' => '(c|t)'
}.inject(seq){|s,ary| s.gsub( *ary ) }.size )

