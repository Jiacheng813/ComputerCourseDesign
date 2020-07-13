#include<iostream>
#include"Graph.h"
int const INFINITY=MAXINT+1;
bool final[MVNum];//final[v]为1当且仅当点v属于S
int Path[MVNum][MVNum];//Path[v][w]表示点w在点v0到点v的最短路径上的顺序 
int Path_ad[MVNum][MVNum];	
int Dist[MVNum];//Dist[v]是v0到V-S集合内点v的最短路径的带权长度 
void PrintPathMatrix(DGraph G,int v0){
	cout<<"Path["<<G.vexnum<<"]["<<G.vexnum<<"]:"<<endl;//打印Path[][] 
	cout<<setw(6)<<" "<<" ";
	for(int v=0;v<G.vexnum;++v)
		cout<<setw(6)<<G.vexs[v]<<" ";
	cout<<endl;
	for(int v=0;v<G.vexnum;++v){
	 	cout<<setw(6)<<G.vexs[v]<<" ";
		for(int w=0;w<G.vexnum;++w){
			cout<<setw(6)<<Path[v][w]<<" ";
		}
		cout<<endl;
	} 
	cout<<"Path_ad["<<G.vexnum<<"]["<<G.vexnum<<"]:"<<endl;  
	cout<<setw(6)<<" "<<" ";
	for(int v=0;v<G.vexnum;++v)
		cout<<setw(6)<<v<<" ";
	cout<<endl;
	for(int v=0;v<G.vexnum;++v){//打印Path_ad[][]
		cout<<setw(6)<<G.vexs[v]<<" ";
		for(int w=0;w<G.vexnum;++w){
			cout<<setw(6);
			if(Path_ad[v][w]>=0)
				cout<<G.vexs[Path_ad[v][w]];	
			else if(w==0)
				cout<<G.vexs[v0];
			else
				cout<<" ";
			cout<<" ";
		} 
		cout<<endl; 
	}
	cout<<endl;
}
void PrintDistMatrix(DGraph G){
	cout<<"Dist["<<G.vexnum<<"]:"<<endl; 
	for(int v=0;v<G.vexnum;++v)
		cout<<setw(6)<<G.vexs[v]<<" ";
	cout<<endl;
	for(int v=0;v<G.vexnum;++v)
		cout<<setw(6)<<Dist[v]<<" ";
}
void Dijkstra(DGraph G,int v0){
	int v;
	for(int i=0;i<G.vexnum;++i)
		for(int j=0;j<G.vexnum;++j)
			Path_ad[i][j]=-1;		
	Path[G.vexnum][G.vexnum]=-1; 
	for(v=0;v<G.vexnum;++v){ //初始化 
		final[v]=0;
		Dist[v]=G.adj_matrix.arc_weight[v0][v];//点v0到点v的带权长度初始化为<v0,v>的权值 
		for(int w=0;w<G.vexnum;++w) Path[v][w]=-1; 
		if(Dist[v]<INFINITY){
			Path[v][v0]=0;//第一个点为v0本身 
			Path[v][v]=1;//第二个点为v 
		}
	}
	Dist[v0]=0;//点v0到点v0距离为0 
	final[v0]=1; 
	//Path[v0][v0]=1; 
	for(int i=1;i<G.vexnum;++i){ 
		int min=INFINITY;
		for(int w=0;w<G.vexnum;++w){ 
			if(!final[w]) 
				if(Dist[w]<min){
					v=w;//找到距离最近的点v 
					min=Dist[w];
				}
		} 
		final[v]=1;
		for(int w=0;w<G.vexnum;++w){
			if(!final[w] && (min+G.adj_matrix.arc_weight[v][w]<Dist[w])){//点v0到点v的最短距离+<v,w>小于点v0到点w的最短距离 
				Dist[w]=min+G.adj_matrix.arc_weight[v][w];
				for(int t=0;t<G.vexnum;++t)//点v0到点w路径上存在的点变为点v0到点v路径上存在的点加上点v和点w 
					Path[w][t]=Path[v][t];
				Path[w][w]=Path[v][v]+1;//w是v后面的一个点 
			}
		}
	} 
	for(int v=0;v<G.vexnum;++v){//求Path_ad[][] 
		for(int w=0;w<G.vexnum;++w){
			if(Path[v][w]>0) Path_ad[v][Path[v][w]]=w;
		}
	} 
	cout<<"起点\t"<<"终点\t"<<"最短路径\t"<<"权值\n"; 
	for(int v=0;v<G.vexnum;++v){
		if(v==v0) continue; 
		cout<<G.vexs[v0]<<"\t"<<G.vexs[v]<<"\t"; 
		int vt=v0; bool flag=0;
		for(int w=1;w<G.vexnum;++w){
			if(Path_ad[v][w]>=0){
				flag=1;
				cout<<G.vexs[vt]<<"->"<<G.vexs[Path_ad[v][w]]<<',';
				vt=Path_ad[v][w];
			}
			
		}
		cout<<"\t"<<Dist[v]<<" ";
		if(flag) cout<<"\b.";
		cout<<endl;
	}
} 
