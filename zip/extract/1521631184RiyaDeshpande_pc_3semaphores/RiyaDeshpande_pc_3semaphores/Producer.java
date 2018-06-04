/*If you want you can make methods for all the acquire and release
eg
ProducerConsumerDemo::acquireEmptyCount();*/
class Producer extends Thread{

	ProducerConsumerDemo pcDemo;
	String name;

	Producer(ProducerConsumerDemo producerConsumerDemo,String name){
		this.pcDemo=producerConsumerDemo;
		this.name=name;
	}

	public void run(){
		try{

			while (true) 
    		{
    			Thread.sleep(1000);
    			pcDemo.emptyCount.acquire();
            	pcDemo.buffer_mutex.acquire();
                pcDemo.current_buffer_size++;
                System.out.println("Hi i am "+name+" Producer"+pcDemo.current_buffer_size);
            	pcDemo.buffer_mutex.release();
        		pcDemo.fillCount.release();
        		Thread.sleep(100);
    		}

		}catch(InterruptedException ie){
			System.out.println(this+"Thread Interrupted");
		}
	}

}