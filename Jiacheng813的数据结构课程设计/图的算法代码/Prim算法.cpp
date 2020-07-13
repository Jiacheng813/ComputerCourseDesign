#include<iostream>
#include"Graph.h"
using namespace std;
typedef struct{
	VertexType adjvex;
	int lowcost;
}Closedge[MVNum];
static int minimum(UDGraph G,Closedge closedge){// 求集合V-U内到集合U内任意一点距离最短的点 
	int x=0,x_min,t;//x_min为到集合U内点距离最小的点
	while(x<G.vexnum && closedge[x].lowcost==0) ++x;//找到第一个不在集合U内的点 
	if(x>G.vexnum-1){//若所有点已被包含在集合U里 
		cout<<"ERROR"<<endl;
		return -1;
	}  
	x_min=x++;//x跳到x_min的下一个顶点 
	while(x<G.vexnum ){//在集合V-U中 
		if((t=closedge[x].lowcost)!=0 && t<closedge[x_min].lowcost) x_min=x;//若t小于最小的到集合U内点的距离，更新x_min 
		x++;
	}
	return x_min;
}
void Prim(UDGraph G,VertexType u){//u是开始的顶点 
	int total_weight=0; 
	Closedge closedge;
	int k=G.LocateVex(u);
	for(int j=0;j<G.vexnum;++j){
		if(j!=k){
			closedge[j].adjvex=u;//点j到集合U中任意一点距离最短的是点k（一开始集合U只包含点k） 
			closedge[j].lowcost=G.adj_matrix.arc_weight[k][j];//点j到集合U中任意一点的最短距离，初始化为点k到点j的弧的权值，若无弧则为MAXINT 
		}
	}
	closedge[k].lowcost=0;//点k一开始就存在集合U中 
	cout<<"路径\t"<<"权值\n";
	for(int i=1;i<G.vexnum;++i){//循环次数为剩下的顶点数 
		k=minimum(G,closedge); //k为到集合外距离最短的点  
		total_weight+=closedge[k].lowcost;
		cout<<closedge[k].adjvex<<"->"<<G.vexs[k]<<"\t"<<closedge[k].lowcost<<endl;//打印生成的边 
		closedge[k].lowcost=0;//k号顶点并入U集
		for(int j=0;j<G.vexnum;++j){//遍历所有（其他）点 
			if(G.adj_matrix.arc_weight[k][j]<closedge[j].lowcost){//如果新加入的点k到集合V-U内一点的距离小于此点到集合U内点的最小距离 
				closedge[j].adjvex=G.vexs[k];//更新此点到集合U内距离最小的点为点k 
				closedge[j].lowcost=G.adj_matrix.arc_weight[k][j];//更新此点到集合U内点的最小距离为此点到点k的距离 
			}
		} 
	}
	cout<<"总权值="<<total_weight<<endl;
} 

