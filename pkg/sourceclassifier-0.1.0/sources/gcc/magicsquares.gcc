/* The Computer Language Benchmarks Game
   http://shootout.alioth.debian.org/
 
   contributed contributed by Charlie Brej
 */

#include <stdio.h>
#include <stdlib.h>

int n=0;
int mn=0;

typedef struct FfmCache {
    int x;
    int y;
    int pm_count;
    int pm[];
    }FfmCache, *PtrFfmCache;

typedef struct Square {
    struct Square* next;
    PtrFfmCache ffm;
    int priority;
    int *grid;
    int *unused;
    }Square, *PtrSquare;


  
void SquarePrint(PtrSquare square)
{
    int x;
    int y;
    for (y=0; y<n; y++){
        for (x=0; x<n; x++){
            printf("%d ", square->grid[x+y*n]);
            }
        printf("\n");
        }
    return;
}


    
PtrSquare SquareNew(void)
{
    PtrSquare new_square = malloc(sizeof(Square));
    new_square->grid = malloc(n * n * sizeof(int));
    new_square->unused = malloc(n * n * sizeof(int));
    new_square->next=NULL;
    new_square->ffm=NULL;
    new_square->priority=0;
    return new_square;
}

PtrSquare SquareNewEmpty(void)
{
    int i;
    PtrSquare new_square = SquareNew();
    for (i=0; i<n*n; i++){
        new_square->grid[i]=0;
        new_square->unused[i]=1;
        }
    return new_square;
}


PtrSquare SquareNewCopy(PtrSquare old_square)
{
    int i;
    PtrSquare new_square = SquareNew();
    for (i=0; i<n*n; i++){
        new_square->grid[i]=old_square->grid[i];
        new_square->unused[i]=old_square->unused[i];
        }
    return new_square;
}
    
void SquareFree(PtrSquare square)
{
    free(square->ffm);
    free(square->unused);
    free(square);
    return ;
}
   
void SquareGetRow(PtrSquare square, int row, int* out_array)
{
 int i;
 for (i=0; i<n; i++){
    out_array[i] = square->grid[row*n+i];
    }
}
    
void SquareGetColumn(PtrSquare square, int column, int* out_array)
{
 int i;
 for (i=0; i<n; i++){
    out_array[i] = square->grid[n*i+column];
    }
}
    
int IntArraySum(int* data)
{
 int i;
 int sum = 0;
 for (i=0; i<n; i++){
    sum += data[i];
    }
 return sum;
}

int IntArrayCount0s(int* data)
{
 int i;
 int count = 0;
 for (i=0; i<n; i++)
    if(data[i]==0)
        count++;
 return count;
}

int SquareNumberPresent(PtrSquare square, int number)
{
    int i;
    for (i=0; i<n*n; i++){
        if (square->grid[i] == number) return 1;
        }
    return 0;
}

int SquareEmptyCount(PtrSquare square)
{
    int i;
    int count=0;
    for (i=0; i<n*n; i++){
        if (square->grid[i] == 0) count++;
        }
    return count;
}

void SquareGetPossibleMoves(PtrSquare square, int x, int y, int* ret_pm, int* ret_pm_count)
{
    int cell_groups[4][n];
    int cell_group_count=2;
    int group;
    int i, i2;
    int cur_acc;
    int highest_candidate = n*n;
    int lowest_candidate = 1;
    
    int one_possible = 0;
    
    
    SquareGetRow(square, y, cell_groups[0]);
    SquareGetColumn(square, x, cell_groups[1]);
    
    *ret_pm_count = 0;
    if (x==y) {
        for (i=0; i<n; i++)
            cell_groups[cell_group_count][i] = square->grid[n*i+i];
        cell_group_count++;
        }
    if (x + y == n - 1) {
        for (i=0; i<n; i++)
            cell_groups[cell_group_count][i] = square->grid[i + (n - 1 - i) * n];
        cell_group_count++;
        }
    
    for (group=0; group<cell_group_count; group++){
        int count = 0;
        for (i=0; i<n; i++){
            if (cell_groups[group][i] == 0){
                if (count++) break;
                }
            }
        if (count==1){
            int new_one_possible = mn - IntArraySum(cell_groups[group]);
            if (one_possible==0){
                one_possible = new_one_possible;
                if (one_possible<1 || one_possible>n*n || SquareNumberPresent(square, one_possible)) return;
                }
            if (one_possible != new_one_possible) return;
            }
        }
    if (one_possible){
        ret_pm[0] = one_possible;
        *ret_pm_count = 1;
        return;
        }
    
    
    int local_pm_count = 0;
    int zeros[cell_group_count];
    int highest_zero_count=0;
    for (i=0; i<cell_group_count; i++){
        int zero_count = IntArrayCount0s(cell_groups[i])-1;
        zeros[i] = zero_count;
        if (highest_zero_count < zero_count) highest_zero_count = zero_count;
        }
    
    int lows[highest_zero_count];
    int higs[highest_zero_count];
    
    i2=0;
    cur_acc=0;
    for (i=0; i2<highest_zero_count; i++){
        if(square->unused[i]){
            cur_acc+=(i+1);
            lows[i2]=cur_acc;
            i2++;
            }
        }
    
    i2=0;
    cur_acc=0;
    for (i=n*n-1; i2<highest_zero_count; i--){
        if(square->unused[i]){
            cur_acc+=(i+1);
            higs[i2]=cur_acc;
            i2++;
            }
        }
    
    for (group=0; group<cell_group_count; group++){
        int lft = mn - IntArraySum(cell_groups[group]);
        int k = zeros[group];
        int temp_highest_candidate = lft - lows[k-1];
        int temp_lowest_candidate = lft - higs[k-1];
        if (temp_highest_candidate<highest_candidate) highest_candidate = temp_highest_candidate;
        if (temp_lowest_candidate>lowest_candidate)   lowest_candidate =  temp_lowest_candidate;
        }
    
    for (i=lowest_candidate; i<=highest_candidate; i++){
        if(square->unused[i-1]){
            ret_pm[local_pm_count++]=i;
            
            }
            
        }
    
        
    *ret_pm_count = local_pm_count;
    return;
    
    
}


PtrFfmCache SquareGetFewestMoves(PtrSquare square)
{
    int x,y;
    int i;
    if (square->ffm){
        return square->ffm;
        }
    square->ffm = malloc(sizeof(FfmCache)+sizeof(int)*n*n);
    square->ffm->pm_count=n*n+1;
    
    for (y=0; y<n; y++)
        for (x=0; x<n; x++){
            int index = x + y * n;
            if (square->grid[index] == 0){
                int temp_list[n*n];
                int temp_list_count;
                SquareGetPossibleMoves(square,x,y,temp_list,&temp_list_count);
                if (temp_list_count<square->ffm->pm_count){
                    square->ffm->pm_count = temp_list_count;
                    square->ffm->x = x;
                    square->ffm->y = y;
                    for (i=0; i<square->ffm->pm_count; i++) square->ffm->pm[i] = temp_list[i];
                    }
                }
            }
    
    
    if (square->ffm->pm_count>n*n) square->ffm->pm_count=0;
    return square->ffm;
    
    
}

   
int SquareGetPriority(PtrSquare square)
{
    int priority;
    if (square->priority) return square->priority;
    PtrFfmCache ffm = SquareGetFewestMoves(square);
    priority = ffm->pm_count + SquareEmptyCount(square);
    square->priority = priority;
    return priority;
}

int SquareCompare(PtrSquare square1, PtrSquare square2)
{
 int c = SquareGetPriority(square1) - SquareGetPriority(square2);
 if (c==0){
    int i;
    for (i=0; c==0 && i<n*n; i++){
        c = square1->grid[i] - square2->grid[i];
        }
    }
 return c;
}

PtrSquare SquareQueueMerge(PtrSquare queue1, PtrSquare queue2)
{
    if (!queue1) return queue2;
    if (!queue2) return queue1;
    
    PtrSquare new_queue = NULL;
    PtrSquare* cur_ptr = &new_queue;
    
    while (1){
        if (SquareCompare(queue1, queue2)<0){
            *cur_ptr = queue1;
            cur_ptr = &queue1->next;
            queue1 = queue1->next;
            if (!queue1){
                *cur_ptr = queue2;
                return new_queue;
                }
            }
        else {
            *cur_ptr = queue2;
            cur_ptr = &queue2->next;
            queue2 = queue2->next;
            if (!queue2){
                *cur_ptr = queue1;
                return new_queue;
                }
            }
        }
}

PtrSquare SquareGetSuccessorNodes(PtrSquare square)
{
    int i;
    PtrSquare square_queue = NULL;
    PtrFfmCache ffm = SquareGetFewestMoves(square);
    
    for (i=0; i<ffm->pm_count; i++){
        PtrSquare new_square = SquareNewCopy(square);
        new_square->grid[ffm->x+ffm->y*n] = ffm->pm[i];
        new_square->unused[ffm->pm[i]-1]=0;
        square_queue = SquareQueueMerge(square_queue, new_square);
        }
    return square_queue;
}



int main(int argc, char **argv)
{
   
    if (argv[1]) n = atoi(argv[1]);
    else         n = 5;
    mn = n * (1 + n * n) / 2;
    
    PtrSquare queue = SquareNewEmpty();
    PtrSquare cur_square;
    
    while (queue){
        cur_square = queue;
        queue = queue->next;
        
        int priority = SquareGetPriority(cur_square);
        if (!priority) break;
        
        
        PtrSquare successor_nodes = SquareGetSuccessorNodes(cur_square);
        queue = SquareQueueMerge(queue, successor_nodes);
        SquareFree(cur_square);
        }
    
    SquarePrint(cur_square);
    return 0;
}
