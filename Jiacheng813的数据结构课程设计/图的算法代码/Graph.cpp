#pragma once
#include<iostream>
#include"Graph.h"
using namespace std;
Graph::Graph(int vex_num,int arc_num){	
	vexnum=vex_num;
	arcnum=arc_num;
	for(int i=0;i<vexnum;++i){
		for(int j=0;j<vexnum;++j){
			adj_matrix.arc_weight[i][j]=MAXINT;
		}
	}	
	Graph::total_number++;
	no++;
} 
void Graph::add_vertex(VertexType v){
	vexs[vexnum++]=v;
}
void Graph::PrintAdjMatrix(){
	cout<<setw(6)<<" "<<" ";
	for(int i=0;i<vexnum;++i)
		cout<<setw(6)<<vexs[i]<<" ";
	cout<<endl;
	for(int i=0;i<vexnum;++i){
	    cout<<setw(6)<<vexs[i]<<" ";
	    for(int j=0;j<vexnum;++j){
			if(adj_matrix.arc_weight[i][j]!=MAXINT)	
	        	cout<<setw(6)<<adj_matrix.arc_weight[i][j]<<" ";
			else	
				cout<<setw(6)<<"0"<<" ";	
		}
		cout<<endl;
	}
}
int Graph::LocateVex(VertexType v){	
	for(int i=0;i<vexnum;++i){
		if(vexs[i]==v)
			return i;
	}
	return -1;
}
UDGraph::UDGraph(int vexnum,int arcnum):Graph(vexnum,arcnum){
} 
void UDGraph::adj_list_insert(Edge &e){
	Edge* p=adj_list_UD[e.tail].first_edge,*pt=p;
	if(!p){
		adj_list_UD[e.tail].first_edge=(Edge*)malloc(sizeof(Edge));
		*(adj_list_UD[e.tail].first_edge)=e;
	}
	else{
		while(p=p->next_edge){
			pt=p;
		}
		pt->next_edge=(Edge*)malloc(sizeof(Edge));
		*(pt->next_edge)=e;;
	} 
	Edge* p2=adj_list_UD[e.head].first_edge,*pt2=p2;
	if(!p2){
		adj_list_UD[e.head].first_edge=(Edge*)malloc(sizeof(Edge));
		*(adj_list_UD[e.head].first_edge)=e;
	}
	else{
		while(p2=p2->next_edge){
			pt2=p2;
		}
		pt2->next_edge=(Edge*)malloc(sizeof(Edge));
		*(pt2->next_edge)=e;;
	} 
}	
void UDGraph::add_edge(int tail,int head,int weight,int no){
	Edge e;
	e.tail=tail;
	e.head=head;
	e.weight=weight;
	e.no=no;
	edges.push_back(e);
	adj_list_insert(e);
}
void UDGraph::PrintAdjList(){	
	for(int i=0;i<vexnum;++i){ 			
		cout<<left<<setw(6)<<vexs[i]<<" ";
		Edge* p=adj_list_UD[i].first_edge;
		while(p){
			cout<<p->head<<" "<<left<<setw(4)<<p->weight<<" ";
			p=p->next_edge;
		}	
		cout<<endl;
	}	
}
void UDGraph::FindAllInDegree(){
	for(int i=0;i<vexnum;++i){
		for(Edge *p=adj_list_UD[i].first_edge; p; p=p->next_edge){
			++indegree[p->tail];
			++indegree[p->head];
		}
	}
}
DGraph::DGraph(int vexnum,int arcnum):Graph(vexnum,arcnum){//¹¹Ôìº¯Êý 		
}
void DGraph::adj_list_insert(Arc &e){
	Arc* p=adj_list_D[e.tail].first_arc,*pt=p;
	if(!p){
		adj_list_D[e.tail].first_arc=(Arc*)malloc(sizeof(Arc));
		*(adj_list_D[e.tail].first_arc)=e;
	}
	else{
		while(p=p->next_arc){
			pt=p;
		}
		pt->next_arc=(Arc*)malloc(sizeof(Arc));
		*(pt->next_arc)=e;;
	} 
}
void DGraph::add_arc(int tail,int head,int weight,int no){
	Arc e;
	e.tail=tail;
	e.head=head;
	e.weight=weight;
	e.no=no;
	arcs.push_back(e);
	adj_list_insert(e);
}
void DGraph::PrintAdjList(){	
	for(int i=0;i<vexnum;++i){ 			
		cout<<left<<setw(6)<<vexs[i]<<" ";
		Arc* p=adj_list_D[i].first_arc;
		while(p){
			cout<<p->head<<" "<<left<<setw(4)<<p->weight<<" ";
			p=p->next_arc;
		}	
		cout<<endl;
	}	
}
void DGraph::FindAllInDegree(){
	for(int i=0;i<vexnum;++i){
		for(Arc *p=adj_list_D[i].first_arc; p; p=p->next_arc){
			++indegree[p->head];
		}
	}
}
