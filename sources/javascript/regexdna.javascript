// The Computer Language Shootout
// http://shootout.alioth.debian.org/
//
// contributed by Jesse Millikan
// Base on the Ruby version by jose fco. gonzalez

var l, input = "", ilen, clen, 
 seqs = [
  /agggtaaa|tttaccct/ig,
  /[cgt]gggtaaa|tttaccc[acg]/ig,
  /a[act]ggtaaa|tttacc[agt]t/ig,
  /ag[act]gtaaa|tttac[agt]ct/ig,
  /agg[act]taaa|ttta[agt]cct/ig,
  /aggg[acg]aaa|ttt[cgt]ccct/ig,
  /agggt[cgt]aa|tt[acg]accct/ig,
  /agggta[cgt]a|t[acg]taccct/ig,
  /agggtaa[cgt]|[acg]ttaccct/ig],
 subs = { 
  B: '(c|g|t)', D: '(a|g|t)', H: '(a|c|t)', K: '(g|t)', 
  M: '(a|c)', N: '(a|c|g|t)', R: '(a|g)', S: '(c|t)', 
  V: '(a|c|g)', W: '(a|t)', Y: '(c|t)' }
 
// readline strips the newline...
while(l = readline()) input += l + "\n"
ilen = input.length

// There is no in-place substitution
input = input.replace(/>.*\n|\n/g,"")
clen = input.length

for(i in seqs)
 print(seqs[i].source, (input.match(seqs[i]) || []).length)
 // match returns null if no matches, so replace with empty

for(k in subs)
 input = input.replace(k, subs[k], "g")
 // search string, replacement string, flags

print()
print(ilen)
print(clen)
print(input.length)

