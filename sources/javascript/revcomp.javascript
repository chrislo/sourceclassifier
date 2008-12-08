/*     
The Computer Language Shootout   
http://shootout.alioth.debian.org/  
Contributed by Jesse Millikan    
*/

var keys='WSATUGCYRKMBDHVN',
    comps='WSTAACGRYMKVHDBN',
    complement=[],
    seq="",l,i

for(i in keys) complement[keys.charCodeAt(i)] = comps[i]

function revcomp(seq){
 var rseq = "", l = seq.length - 1, i

 for(i = l; i >= 0; i--)
  rseq += complement[seq.charCodeAt(i)]

 for(i = 0; i < l; i += 60)
  print(rseq.substr(i, 60))
}

while(l = readline()){
 if(l.match(/>/)){
  if(seq.length != 0){
   revcomp(seq)
   seq = ""
  }
  print(l)
 }
 else seq += l.toUpperCase()
}

revcomp(seq)
