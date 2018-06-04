class Consumer extends Thread{

	ProducerConsumerDemo pcDemo;
	String name;

	Consumer(ProducerConsumerDemo producerConsumerDemo,String name){
		this.pcDemo=producerConsumerDemo;
		this.name=name;
	}

	public void run(){
		try{

			while (true) 
    		{
    			Thread.sleep(100);
        		pcDemo.fillCount.acquire();
            	pcDemo.buffer_mutex.acquire();
                pcDemo.current_buffer_size--;
                System.out.println("Hi i am "+name+" Consumer "+pcDemo.current_buffer_size);
            	pcDemo.buffer_mutex.release();
        		pcDemo.emptyCount.release();
        		Thread.sleep(1000);
    		}

		}catch(InterruptedException ie){
			System.out.println(this+"Thread Interrupted");
		}
	}

}