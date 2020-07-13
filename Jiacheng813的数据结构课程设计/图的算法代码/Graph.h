#pragma once
int const MAXINT=32767;//边(弧)的最大权值 
int const MVNum=100;//图的最大顶点数量 
typedef char VertexType;//顶点的信息类型 
typedef int ArcType;//边(弧)的权值类型 

class Graph{	
//成员变量 
	public:
	static int total_number;//创建的图的总数量 
	int no=0;//图的编号 
	int vexnum=0;//顶点数 
	int arcnum=0;//边(弧)的数量 
	int indegree[MVNum]={0};//记录每个顶点入度的数组  	
	VertexType vexs[MVNum];//记录顶点的数组 
	struct{
		ArcType arc_weight[MVNum][MVNum];
	}adj_matrix;//邻接矩阵的结构定义 
//成员函数 	
	public:
	Graph(int a,int b);//构造函数 
	void add_vertex(VertexType v);//将顶点添加到顶点数组里的函数 
	void PrintAdjMatrix();//打印邻接矩阵的函数 
	int LocateVex(VertexType v);//由顶点信息找顶点序号的函数 
};
int Graph::total_number=0; 
class UDGraph:public Graph{
//类型定义 
	public:
	typedef struct Edge{
		int no;//编号 
		int tail;//顶点1 
		int head;//顶点2 
		int weight;//权值
		Edge* next_edge=NULL;//指向下一条边的指针 
	}Edge;//边的类型定义
	typedef vector<Edge> edges_type;//包含所有边的数组的类型定义 
//成员变量 
	public:	
	edges_type edges;//包含所有边的数组 	
	struct VNode{
		VertexType data;
		Edge* first_edge=NULL;
	}adj_list_UD[MVNum];//邻接表 
	int indegree[MVNum];//记录每个顶点入度的数组 
//成员函数 
	public:
	UDGraph(int vexnum,int arcnum);//构造函数 
	void adj_list_insert(Edge &e);//将边添加到邻接矩阵里的函数 
	void add_edge(int tail,int head,int weight,int no);//将边添加到边数组里的函数 
	void PrintAdjList();//打印邻接表 
	void FindAllInDegree();//计算每个顶点的入度 
};
class DGraph:public Graph{
//类型定义 	
	public:
	typedef struct Arc{
		int no;//编号 
		int tail;//弧尾 
		int head;  //弧头 
		int weight;//弧的权值
		Arc* next_arc=NULL;//指向下一条弧的指针 
	}Arc;//弧的类型定义
	typedef vector<Arc>arcs_type;//包含所有弧的数组的类型定义 
//成员变量 	
	public: 	
	arcs_type arcs;//包含所有弧的数组
	struct VNode{
		VertexType data;
		Arc* first_arc=NULL;
	}adj_list_D[MVNum];//邻接表 
//成员函数 
	public:
	DGraph(int vexnum,int arcnum);//构造函数 
	void adj_list_insert(Arc &e);//将弧添加到邻接矩阵里的函数  
	void add_arc(int tail,int head,int weight,int no);//将弧添加到边数组里的函数
	void PrintAdjList();//打印邻接表 
	void FindAllInDegree();//计算每个顶点的入度
};

