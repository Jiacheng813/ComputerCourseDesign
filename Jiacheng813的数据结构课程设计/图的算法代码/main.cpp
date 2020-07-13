using namespace std;
#include<iostream>
#include<string>
#include<vector>
#include<fstream>
#include<iomanip>
#include<windows.h> 
#include"Graph.cpp"
#include"Prim算法.cpp"
#include"Kruskal算法.cpp"
#include"Dijkstra算法.cpp" 
#include"拓扑排序算法.cpp"

void CreateGraph(ifstream &infile,UDGraph &G){
	int arc_no=0;
	    vector<ArcType> v_arc;
	    for(int i=0;i<G.vexnum;++i){
	    	infile>>G.vexs[i];//顶点名称 
		}
		for(int i=0;i<G.arcnum;++i){//读入边 
			VertexType c1,c2;	
			int v1,v2;	
			ArcType weight;
			infile>>c1>>c2>>weight; 
			v1=G.LocateVex(c1); v2=G.LocateVex(c2);
			G.add_edge(v1,v2,weight,arc_no++);
			G.adj_matrix.arc_weight[v1][v2]=G.adj_matrix.arc_weight[v2][v1]=weight;//边是双向的 
		} 
}
void CreateGraph(ifstream &infile,DGraph &G){
	int arc_no=0;
	    vector<ArcType> v_arc;
	    for(int i=0;i<G.vexnum;++i){
	    	infile>>G.vexs[i];//顶点名称 
		}
		for(int i=0;i<G.arcnum;++i){//读入边 
			VertexType c1,c2;	
			int v1,v2;	
			ArcType weight;
			infile>>c1>>c2>>weight; 
			v1=G.LocateVex(c1); v2=G.LocateVex(c2);
			G.add_arc(v1,v2,weight,arc_no++);
			G.adj_matrix.arc_weight[v1][v2]=weight;//弧是单向的 
		} 	
}
enum Color { TRANSP=0, DARKBLUE, DARKGREEN, BLUE, RED, DARKPINK, DARKYELLOW, GRAY, DARKGRAY, LIGHTBLUE, GREEN, TEAL, PINK, PURPLE, YELLOW, WHITE };
void SetColor(Color back_color,Color fore_color){
    HANDLE handle= GetStdHandle(STD_OUTPUT_HANDLE);
    SetConsoleTextAttribute(handle,fore_color|back_color*16);
}
int main(){	
	SetConsoleTitle("\\-----图的算法-----\\");
	int n=1,n2=n;//读入矩阵的编号 
	ifstream infile("input.txt");
  	if(!infile){
	  cout<<"error: fail to open \"input.txt\""<<endl;
	  return -1;
	}
	while(!infile.eof()){		
		char c;	
		infile>>c;
		if(c=='U'){
		    SetColor(RED,GRAY); 
			cout<<">>无向图"<<n<<endl;
			SetColor(TRANSP,GRAY); 
			int vexnum,arcnum;	
			infile>>vexnum;//顶点数量 
		    infile>>arcnum;//边的数量
			UDGraph G(vexnum,arcnum); 
			CreateGraph(infile,G);
			cout<<"--------("<<n<<")--------"<<endl;
			cout<<"图的邻接矩阵为:"<<endl;
			G.PrintAdjMatrix(); 
			cout<<"图的邻接表为:"<<endl;
			G.PrintAdjList();
			SetColor(DARKGREEN,GRAY);
			cout<<endl<<"Prim算法:"<<endl; 
			SetColor(TRANSP,GRAY);
			cout<<endl<<"从顶点"<<G.vexs[4]<<"开始:"<<endl; 
			Prim(G,G.vexs[4]); 	
			SetColor(DARKBLUE,GRAY);
			cout<<endl<<"Kruskal算法:"<<endl;
			SetColor(TRANSP,GRAY);
			Kruskal(G);
			cout<<endl; 
			n++;
		}
		else if(c=='D'){
			SetColor(RED,GRAY);
			cout<<">>有向图"<<n2<<endl;
			SetColor(TRANSP,GRAY);	
			int vexnum,arcnum;
			infile>>vexnum;//顶点数量 
		    infile>>arcnum;//边的数量
			DGraph G2(vexnum,arcnum); 
			CreateGraph(infile,G2); 
			cout<<"--------("<<n2<<")--------"<<endl;
			cout<<"图的邻接矩阵为:"<<endl;
			G2.PrintAdjMatrix(); 
			cout<<"图的邻接表为:"<<endl;
			G2.PrintAdjList();
			SetColor(DARKGREEN,GRAY);
			cout<<"Dijkstra算法:"<<endl;
			SetColor(TRANSP,GRAY);
			cout<<"起点为"<<G2.vexs[4]<<":"<<endl;
			Dijkstra(G2,4);
			cout<<endl;
			SetColor(DARKBLUE,GRAY);
			cout<<"拓扑排序:"<<endl;
			SetColor(TRANSP,GRAY);
			TopologicalSort(G2);
			cout<<endl;
			n2++; 
		}
	} 
	infile.close(); 
	cout<<">>按任意键退出程序"<<endl; 
	getchar(); 
}
