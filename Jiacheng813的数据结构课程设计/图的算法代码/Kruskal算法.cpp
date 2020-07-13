#include<iostream>
#include"Graph.h"
using namespace std;
#define MAXSIZE 100 //顺序表的最大长度
//-----排序算法-----// 
typedef int InfoType;
typedef struct{
	int key; //关键字项
	InfoType otherinfo; //其他数据项
}DataType;
typedef struct{ 
	DataType r[MAXSIZE+1]; //r[0]闲置或用作哨兵单元
	int length;
}SqList;
int Partition(SqList &L,int low,int high){
	int pivot_key=L.r[low].key;	
	L.r[0]=L.r[low];
	while(low<high){
		while(low<high && L.r[high].key>=pivot_key)
			--high;
		L.r[low]=L.r[high];
		while(low<high && L.r[low].key<=pivot_key)
			++low;
		L.r[high]=L.r[low];	
	}
	L.r[low]=L.r[0];
	return low;
}
//快速排序 
void q_sort(SqList &L,int low,int high){
	if(low<high){
		int pivot_loc=Partition(L,low,high);
		q_sort(L,low,pivot_loc-1);
		q_sort(L,pivot_loc+1,high);
		
	}
}
void quick_sort(SqList &L){
	q_sort(L,1,L.length);
} 
void Kruskal(UDGraph G){
	SqList edge_no_list;//为了调用排序函数而，创建存放边序号的临时顺序表 
	edge_no_list.length=0;
	vector<int>set_no_list;//顶点所在的集合编号表 
	int total_weight=0; //最小生成树的总权值 
	for(int i=0;i<G.arcnum;++i){//注意，sqlist的r[0]是哨兵 
		edge_no_list.r[i+1].key=G.edges[i].weight;//把无向图G的边的权值装入sqlist 
		edge_no_list.r[i+1].otherinfo=G.edges[i].no; //序号装入sqlist 
		edge_no_list.length++;
	}
	UDGraph::edges_type temp_edges(G.edges);//将原来的edges保存起来 
	quick_sort(edge_no_list);//按照边的权值将edge_no_list升序排序 
	for(int i=0;i<G.arcnum;++i){
		temp_edges[i]=G.edges[edge_no_list.r[i+1].otherinfo];//temp_edges替换为edge_no_list的顺序
	}
	for(int i=0;i<G.vexnum;++i){
		set_no_list.push_back(i);//初始时，每个顶点所在集合的编号都为顶点编号 
	}
	cout<<"路径\t"<<"权值\n";
	for(int i=0;i<G.arcnum;++i){	
		int no1,no2,v1=temp_edges[i].tail,v2=temp_edges[i].head;
		no1=set_no_list[v1]; 
		no2=set_no_list[v2];
		if(no1!=no2){//一条边的两个顶点不属于同一集合
			set_no_list[no2]=no1;//将其中一个顶点并入另一顶点所在集合
			total_weight+=temp_edges[i].weight;	
			cout<<G.vexs[v1]<<"->"<<G.vexs[v2]<<"\t"<<temp_edges[i].weight<<endl;//打印生成的路径 
		}
	}
	cout<<"总权值="<<total_weight<<endl;
}
