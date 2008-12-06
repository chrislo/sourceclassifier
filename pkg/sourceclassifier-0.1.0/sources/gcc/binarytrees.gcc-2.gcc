/* The Computer Language Shootout Benchmarks
http://shootout.alioth.debian.org/

contributed by Benoit Hudson based on a contribution of Kevin Carson
compilation:
gcc -O3 -fomit-frame-pointer binary-trees-2.c
 */

#include <stdlib.h>
#include <stdio.h>

typedef struct tn {
  struct tn*    left;
  struct tn*    right;
  long          item;
} treeNode;

static treeNode *freelist = 0;

treeNode* NewTreeNode(treeNode* left, treeNode* right, long item)
{
  treeNode*    new;

  if (NULL == freelist) {
    new = (treeNode*)malloc(sizeof(treeNode));
  } else {
    new = freelist;
    freelist = freelist -> left;
  }

  new->left = left;
  new->right = right;
  new->item = item;

  return new;
} /* NewTreeNode() */


long ItemCheck(treeNode* tree)
{
  if (tree->left == NULL)
    return tree->item;
  else
    return tree->item + ItemCheck(tree->left) - ItemCheck(tree->right);
} /* ItemCheck() */


treeNode* BottomUpTree(long item, unsigned depth)
{
  if (depth > 0)
    return NewTreeNode
      (
       BottomUpTree(2 * item - 1, depth - 1),
       BottomUpTree(2 * item, depth - 1),
       item
      );
  else
    return NewTreeNode(NULL, NULL, item);
} /* BottomUpTree() */


void DeleteTree(treeNode* tree)
{
  if (tree->left != NULL)
  {
    DeleteTree(tree->left);
    DeleteTree(tree->right);
  }

  tree -> left = freelist;
  freelist = tree;
} /* DeleteTree() */


int main(int argc, char* argv[])
{
  unsigned   N, depth, minDepth, maxDepth, stretchDepth;
  treeNode   *stretchTree, *longLivedTree, *tempTree;

  N = atol(argv[1]);

  minDepth = 4;

  if ((minDepth + 2) > N)
    maxDepth = minDepth + 2;
  else
    maxDepth = N;

  stretchDepth = maxDepth + 1;

  stretchTree = BottomUpTree(0, stretchDepth);
  printf
    (
     "stretch tree of depth %u\t check: %li\n",
     stretchDepth,
     ItemCheck(stretchTree)
    );

  DeleteTree(stretchTree);

  longLivedTree = BottomUpTree(0, maxDepth);

  for (depth = minDepth; depth <= maxDepth; depth += 2)
  {
    long    i, iterations, check;

    iterations = 1 << (maxDepth - depth + minDepth);

    check = 0;

    for (i = 1; i <= iterations; i++)
    {
      tempTree = BottomUpTree(i, depth);
      check += ItemCheck(tempTree);
      DeleteTree(tempTree);

      tempTree = BottomUpTree(-i, depth);
      check += ItemCheck(tempTree);
      DeleteTree(tempTree);
    } /* for(i = 1...) */

    printf
      (
       "%li\t trees of depth %u\t check: %li\n",
       iterations * 2,
       depth,
       check
      );
  } /* for(depth = minDepth...) */

  printf
    (
     "long lived tree of depth %u\t check: %li\n",
     maxDepth,
     ItemCheck(longLivedTree)
    );

  return 0;
} /* main() */

