/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements. See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership. The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied. See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */

// This autogenerated skeleton file illustrates how to build a server.
// You should copy it to another filename to avoid overwriting it.

#include "ThreadsTest.h"
#include <thrift/protocol/TBinaryProtocol.h>
#include <thrift/server/TThreadPoolServer.h>
#include <thrift/server/TThreadedServer.h>
#include <thrift/transport/TServerSocket.h>
#include <thrift/transport/TTransportUtils.h>
#include <thrift/concurrency/Monitor.h>
#include <thrift/concurrency/ThreadManager.h>
#include <thrift/concurrency/ThreadFactory.h>
#if _WIN32
   #include <thrift/windows/TWinsockSingleton.h>
#endif

using boost::shared_ptr;
using namespace apache::thrift;
using namespace apache::thrift::protocol;
using namespace apache::thrift::transport;
using namespace apache::thrift::server;
using namespace apache::thrift::concurrency;


class ThreadsTestHandler : virtual public ThreadsTestIf {
 public:
  ThreadsTestHandler() {
    // Your initialization goes here
  }

  int32_t threadOne(const int32_t sleep) {
    // Your implementation goes here
    printf("threadOne\n");
    go2sleep(1, sleep);
    return 1;
  }

  int32_t threadTwo(const int32_t sleep) {
    // Your implementation goes here
    printf("threadTwo\n");
    go2sleep(2, sleep);
    return 1;
  }

  int32_t threadThree(const int32_t sleep) {
    // Your implementation goes here
    printf("threadThree\n");
    go2sleep(3, sleep);
    return 1;
  }

  int32_t threadFour(const int32_t sleep) {
    // Your implementation goes here
    printf("threadFour\n");
    go2sleep(4, sleep);
    return 1;
  }

  int32_t stop() {
    printf("stop\n");
    server_->stop();
    return 1;
  }

  void setServer(boost::shared_ptr<TServer> server) {
    server_ = server;
  }

protected:
  void go2sleep(int thread, int seconds) {
    Monitor m;
    Synchronized s(m);
    for (int i = 0; i < seconds; ++i) {
      fprintf(stderr, "Thread %d: sleep %d\n", thread, i);
      try {
        m.wait(1000);
      } catch(const TimedOutException&) {
      }
    }
    fprintf(stderr, "THREAD %d DONE\n", thread);
  }

private:
  boost::shared_ptr<TServer> server_;

};

int main(int argc, char **argv) {
#if _WIN32
  transport::TWinsockSingleton::create();
#endif
  int port = 9090;
  shared_ptr<ThreadsTestHandler> handler(new ThreadsTestHandler());
  shared_ptr<TProcessor> processor(new ThreadsTestProcessor(handler));
  shared_ptr<TServerTransport> serverTransport(new TServerSocket(port));
  shared_ptr<TTransportFactory> transportFactory(new TBufferedTransportFactory());
  shared_ptr<TProtocolFactory> protocolFactory(new TBinaryProtocolFactory());

  /*
  shared_ptr<ThreadManager> threadManager =
    ThreadManager::newSimpleThreadManager(10);
  shared_ptr<ThreadFactory> threadFactory =
    shared_ptr<ThreadFactory>(new ThreadFactory());
  threadManager->threadFactory(threadFactory);
  threadManager->start();

  shared_ptr<TServer> server =
    shared_ptr<TServer>(new TThreadPoolServer(processor,
                                              serverTransport,
                                              transportFactory,
                                              protocolFactory,
                                              threadManager));
  */

  shared_ptr<TServer> server =
    shared_ptr<TServer>(new TThreadedServer(processor,
                                            serverTransport,
                                            transportFactory,
                                            protocolFactory));

  handler->setServer(server);

  server->serve();

  fprintf(stderr, "done.\n");

  return 0;
}

