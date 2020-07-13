#include"Graph.cpp"
#include <stack>
int TopologicalSort(DGraph G){
	int *indegree=(int*)malloc(G.vexnum*sizeof(int)),count=0;
	stack<int> S;
	for(int i=0;i<G.vexnum;++i)//初始化; 
		indegree[i]=0;
	G.FindAllInDegree();//求所有顶点入度 
	for(int i=0;i<G.vexnum;++i)
		if(!indegree[i])//如果一个顶点的入度为0，则压进栈 
			S.push(i);
	if(!S.empty())
		cout<<"序号\t顶点名"<<endl;
	while(!S.empty()){
		int i;
		i=S.top();
		S.pop();
		++count;
		cout<<count<<"\t"<<G.vexs[i]<<endl;
		for(DGraph::Arc* p=G.adj_list_D[i].first_arc; p; p=p->next_arc){
			if(!(--indegree[p->head]))//以该顶点为弧尾的弧的弧头顶点入度减1 
				S.push(p->head);
		}
	}
	if(count<G.vexnum){//有顶点未被遍历到 
		cout<<"\n该有向图的顶点";
		for(int i=0;i<G.vexnum;++i){
			if(indegree[i]>0)
				cout<<G.vexs[i]<<" ";
		}
		cout<<"\b间存在回路\n"; 
		return -1;
	}
	else{
		cout<<"\n该有向图不存在回路\n";
		return 1;
	}
}
