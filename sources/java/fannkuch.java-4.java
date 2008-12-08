/* The Computer Language Benchmarks Game
   http://shootout.alioth.debian.org/
   C program contributed by Heiner Marxen
   Transliterated to Java by Amir K aka Razii
*/


public final class fannkuch
{
 public static void main(String[] args)
 {
  int n = 11;
  if(args.length == 1) n = Integer.parseInt(args[0]);
  System.out.println("Pfannkuchen(" + n + ") = " + fannkuch(n));
 }
 
 static int fannkuch(final int n)
 {
  int[] perm = new int[n];
  int[] perm1 = new int[n];
  int[] count = new int[n];
  int flips;
  int flipsMax;
  int r;
  int i;
  int k;
  int didpr;
  final int n1 = n - 1;
  if( n < 1 ) return 0;

  for( i=0;i<n;++i ) perm1[i] = i;
  /* initial (trivial) permu */ 
  r = n;
  didpr = 0;
  flipsMax = 0;
  for(;;)
  {
   if( didpr < 30 )
   {
    for( i=0;i<n;++i ) System.out.print (1+perm1[i]);
    System.out.print("\n");
    ++didpr;
   }
   for(;r!=1;--r)
   {
    count[r-1] = r;
   }
   if(!(perm1[0]==0 || perm1[n1]==n1) )
   {
    flips = 0;
    for( i=1;i<n;++i )
    {
     perm[i] = perm1[i];
    }
    k = perm1[0];
    
    /* cache perm[0] in k */ 
    do
    {
     /* k!=0 ==> k>0 */ 
     int j;
     for( i=1, j=k-1;i<j;++i, --j )
     {
      int t_mp = perm[i];
      perm[i] = perm[j];
      perm[j] = t_mp;
     }
     ++flips;
     /* * Now exchange k (caching perm[0]) and perm[k] */ 
     j=perm[k];
     perm[k]=k;
     k=j;
    }
    while(k != 0);
    if( flipsMax < flips )
    {
     flipsMax = flips;
    }
   }
   for(;;)
   {
    if( r == n )
    {
     return flipsMax;
    }
    /* rotate down perm[0..r] by one */
     int perm0 = perm1[0];
     i = 0;
     while( i < r )
     {
      k = i+1;
      perm1[i] = perm1[k];
      i = k;
     }
     perm1[r] = perm0;
    
    if( (count[r] -= 1) > 0 )
    {
     break;
    }
    ++r;
   }
  }
 }
}
